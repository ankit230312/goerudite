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
        Schema::table('rfqs', function (Blueprint $table) {
            $table->json('target_roles')->nullable()->after('city');
            $table->string('target_state')->nullable()->after('target_roles');
            $table->string('target_city')->nullable()->after('target_state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rfqs', function (Blueprint $table) {
            $table->dropColumn(['target_roles', 'target_state', 'target_city']);
        });
    }
};
