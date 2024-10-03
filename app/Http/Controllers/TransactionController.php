<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Invoice;
use Illuminate\Support\Facades\Log; 

class TransactionController extends Controller
{
    public function createTransaction(Request $request)
{
    $client = new Client();
    $url = 'https://tripay.co.id/api-sandbox/transaction/create';

    $merchantCode = env('TRIPAY_MERCHANT_CODE');
    $apiKey = env('TRIPAY_API_KEY');
    $privateKey = env('TRIPAY_PRIVATE_KEY');
    $amount = $request->product_price;
    $orderId = uniqid();

    // Generate signature
    $signature = hash_hmac('sha256', $merchantCode . $orderId . $amount, $privateKey);

    // Data transaksi yang akan dikirim ke API Tripay
    $data = [
        'method' => $request->method,
        'merchant_ref' => $orderId,
        'amount' => $amount,
        'customer_name' => $request->buyer_name,
        'customer_email' => $request->buyer_email,
        'customer_phone' => $request->buyer_phone,
        'order_items' => [
            [
                'sku' => $request->product_id,
                'name' => $request->product_name,
                'price' => $amount,
                'quantity' => 1,
            ],
        ],
        'expired_time' => time() + (24 * 60 * 60), // 1 hari
        'signature' => $signature,
        'return_url' => route('invoices.index'), // Redirect ke halaman invoices setelah pembayaran
    ];

    // Kirim request ke Tripay
    $response = $client->post($url, [
        'headers' => [
            'Authorization' => 'Bearer ' . $apiKey,
        ],
        'json' => $data,
    ]);

    $responseData = json_decode($response->getBody(), true);

    // Jika transaksi berhasil
    if ($responseData['success']) {
        // Simpan data ke tabel invoices
        Invoice::create([
            'product_id' => $request->product_id,
            'tripay_reference' => $responseData['data']['reference'], // Referensi transaksi Tripay
            'buyer_email' => $request->buyer_email,
            'buyer_phone' => $request->buyer_phone,
            'raw_response' => json_encode($responseData), // Simpan response JSON dari Tripay
        ]);

        // Redirect ke URL checkout Tripay untuk menyelesaikan pembayaran
        return redirect($responseData['data']['checkout_url']);
    } else {
        // Jika terjadi error, kembalikan error
        return back()->withErrors(['error' => $responseData['message']]);
    }
}


    public function getPaymentMethods()
    {
        $client = new Client();
        $url = 'https://tripay.co.id/api-sandbox/payment-methods';
        $apiKey = env('TRIPAY_API_KEY');

        $response = $client->get($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
            ],
        ]);

        $responseData = json_decode($response->getBody(), true);

        if ($responseData['success']) {
            return response()->json($responseData['data']);
        } else {
            return response()->json(['error' => $responseData['message']], 400);
        }
    }



    public function showInvoices()
    {
     
        $invoices = Invoice::all();
        return view('invoices.index', compact('invoices'));
    }
}
