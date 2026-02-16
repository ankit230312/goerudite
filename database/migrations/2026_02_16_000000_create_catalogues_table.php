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
        Schema::create('catalogues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('catalogue_title');
            $table->string('publisher_brand_name')->nullable();
            $table->string('academic_session', 50);
            $table->string('applicable_board', 100);
            $table->string('medium', 100);
            $table->integer('print_length')->nullable();
            $table->date('published_on')->nullable();
            $table->string('isbn_13')->nullable();
            $table->string('isbn_10')->nullable();
            $table->string('reading_age')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('volume_part_numbers')->nullable();
            $table->decimal('mrp', 10, 2);
            $table->string('category', 100)->nullable();
            $table->string('cover_file')->nullable();
            $table->string('sample_file')->nullable();
            $table->text('description')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogues');
    }
};
