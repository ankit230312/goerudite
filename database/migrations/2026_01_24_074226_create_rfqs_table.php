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
        Schema::create('rfqs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('school_name');
            $table->string('city');
            $table->string('academic_session');
            $table->json('books'); // Store books as JSON
            $table->date('delivery_from');
            $table->date('delivery_to');
            $table->string('urgency');
            $table->json('evaluation_criteria');
            $table->date('rfq_closing_date');
            $table->text('notes')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->enum('status', ['active', 'closed'])->default('active');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rfqs');
    }
};
