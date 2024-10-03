<?php
use App\Http\Controllers\TransactionController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/create-transaction', [TransactionController::class, 'createTransaction'])->name('create.transaction');

Route::get('/products', [ProductController::class, 'index']);

Route::get('/api/payment-methods', [TransactionController::class, 'getPaymentMethods']);
Route::get('/invoices', [TransactionController::class, 'showInvoices'])->name('invoices.index');
