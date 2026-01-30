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
        Schema::create('purchase_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('record_name');
            $table->string('invoice_no')->nullable();
            $table->date('purchase_date');
            $table->string('item_name');
            $table->string('gst_details')->nullable();
            $table->enum('delivery_status', ['delivered', 'pending', 'cancelled']);
            $table->enum('payment_status', ['paid', 'pending', 'partial']);
            $table->string('supplier');
            $table->integer('quantity');
            $table->decimal('amount', 10, 2);
            $table->string('invoice_file')->nullable();
            $table->string('return_file')->nullable();
            $table->string('document_name')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_records');
    }
};
