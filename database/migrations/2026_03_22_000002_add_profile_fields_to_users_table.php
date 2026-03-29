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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->nullable();
            }
            if (!Schema::hasColumn('users', 'business_name')) {
                $table->string('business_name')->nullable();
            }
            if (!Schema::hasColumn('users', 'contact_person')) {
                $table->string('contact_person')->nullable();
            }
            if (!Schema::hasColumn('users', 'publisher_type')) {
                $table->string('publisher_type')->nullable();
            }
            if (!Schema::hasColumn('users', 'school_type')) {
                $table->string('school_type')->nullable();
            }
            if (!Schema::hasColumn('users', 'institute_type')) {
                $table->string('institute_type')->nullable();
            }
            if (!Schema::hasColumn('users', 'business_category')) {
                $table->string('business_category')->nullable();
            }
            if (!Schema::hasColumn('users', 'mobile')) {
                $table->string('mobile', 20)->nullable();
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable();
            }
            if (!Schema::hasColumn('users', 'gst')) {
                $table->string('gst', 50)->nullable();
            }
            if (!Schema::hasColumn('users', 'pan')) {
                $table->string('pan', 50)->nullable();
            }
            if (!Schema::hasColumn('users', 'city')) {
                $table->string('city', 100)->nullable();
            }
            if (!Schema::hasColumn('users', 'state')) {
                $table->string('state', 100)->nullable();
            }
            if (!Schema::hasColumn('users', 'pincode')) {
                $table->string('pincode', 20)->nullable();
            }
            if (!Schema::hasColumn('users', 'document')) {
                $table->string('document')->nullable();
            }
            if (!Schema::hasColumn('users', 'total_students')) {
                $table->unsignedInteger('total_students')->nullable();
            }
            if (!Schema::hasColumn('users', 'website_link')) {
                $table->string('website_link')->nullable();
            }
            if (!Schema::hasColumn('users', 'established')) {
                $table->string('established')->nullable();
            }
            if (!Schema::hasColumn('users', 'board')) {
                $table->string('board')->nullable();
            }
            if (!Schema::hasColumn('users', 'about')) {
                $table->text('about')->nullable();
            }
            if (!Schema::hasColumn('users', 'profile')) {
                $table->string('profile')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [
                'role',
                'business_name',
                'contact_person',
                'publisher_type',
                'school_type',
                'institute_type',
                'business_category',
                'mobile',
                'address',
                'gst',
                'pan',
                'city',
                'state',
                'pincode',
                'document',
                'total_students',
                'website_link',
                'established',
                'board',
                'about',
                'profile',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
