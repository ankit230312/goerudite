<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rfq_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rfq_id');
            $table->unsignedBigInteger('responder_user_id');
            $table->unsignedBigInteger('responder_company_id');
            $table->string('responder_role', 50);
            $table->decimal('indicative_unit_price', 10, 2)->nullable();
            $table->decimal('total_indicative_value', 12, 2)->nullable();
            $table->unsignedInteger('available_quantity');
            $table->date('delivery_from');
            $table->date('delivery_to');
            $table->string('stock_status', 50)->nullable();
            $table->text('additional_notes')->nullable();
            $table->string('status', 50)->default('RESPONSE_SUBMITTED');
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();

            $table->unique(['rfq_id', 'responder_user_id']);
            $table->index(['responder_role', 'responder_company_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rfq_responses');
    }
};
