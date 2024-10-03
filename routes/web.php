<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']); // Mengarahkan root URL ke halaman produk

Route::post('/create-transaction', [TransactionController::class, 'createTransaction'])->name('create.transaction');

Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::get('/api/payment-methods', [TransactionController::class, 'getPaymentMethods']);

Route::get('/invoices', [TransactionController::class, 'showInvoices'])->name('invoices.index');

