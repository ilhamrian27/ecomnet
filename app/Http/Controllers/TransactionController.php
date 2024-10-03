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

    
    $signature = hash_hmac('sha256', $merchantCode . $orderId . $amount, $privateKey);

 
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
        'expired_time' => time() + (24 * 60 * 60), 
        'signature' => $signature,
        'return_url' => route('invoices.index'), 
    ];

    $response = $client->post($url, [
        'headers' => [
            'Authorization' => 'Bearer ' . $apiKey,
        ],
        'json' => $data,
    ]);

    $responseData = json_decode($response->getBody(), true);

    if ($responseData['success']) {
        Invoice::create([
            'product_id' => $request->product_id,
            'tripay_reference' => $responseData['data']['reference'], 
            'buyer_email' => $request->buyer_email,
            'buyer_phone' => $request->buyer_phone,
            'raw_response' => json_encode($responseData), 
        ]);

      
        return redirect($responseData['data']['checkout_url']);
    } else {
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



    public function showInvoices() {
    $invoices = Invoice::all(); 
    return view('invoices', compact('invoices'));
}

}
