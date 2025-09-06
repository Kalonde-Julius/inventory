<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->foreignId('provider_id')->references('id')->on('providers');
            $table->string('invoice_no');
            $table->date('purchase_date');
            $table->decimal('subtotal')->references('subtotal')->on('products');
            $table->decimal('discount')->references('discount')->on('products');
            $table->decimal('tax')->references('tax')->on('products');
            $table->decimal('total')->references('total')->on('products');
            $table->json('data')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
