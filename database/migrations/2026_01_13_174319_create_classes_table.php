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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('class_name');
            $table->string('academic_session');
            $table->string('board');
            $table->string('medium');
            $table->integer('sections');
            $table->integer('total_students');
            $table->integer('boys')->nullable();
            $table->integer('girls')->nullable();
            $table->integer('expected_admissions')->nullable();
            $table->string('subjects')->nullable();
            $table->string('publisher')->nullable();
            $table->string('syllabus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
