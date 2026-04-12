<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediumsTable extends Migration
{
    public function up()
    {
        Schema::create('mediums', function (Blueprint $table) {
            $table->id('medium_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('board_id')->nullable();

            $table->string('medium_name');
            $table->string('medium_code', 20)->unique();

            $table->string('status')->default('active'); // 1=Active, 0=Inactive

            $table->timestamps();

            // Foreign Keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('board_id')->references('id')->on('boards')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mediums');
    }
}
