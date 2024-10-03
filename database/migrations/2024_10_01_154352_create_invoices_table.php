<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('product_id'); 
            $table->string('tripay_reference'); 
            $table->string('buyer_email'); 
            $table->string('buyer_phone'); 
            $table->text('raw_response'); 
            $table->timestamps(); 


            $table->foreign('product_id')->references('sku')->on('products')->onDelete('cascade');
        });
    }

    /**tes
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
