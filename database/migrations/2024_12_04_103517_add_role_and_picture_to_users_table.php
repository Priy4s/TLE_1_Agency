<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleAndPictureToUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add the 'role' field as an ENUM with default value 'applicant'
            $table->enum('role', ['admin', 'applicant', 'business'])
                ->default('applicant')
                ->after('username');

            // Add the 'picture' field as a nullable VARCHAR
            $table->string('picture')->nullable()->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the 'role' and 'picture' fields
            $table->dropColumn('role');
            $table->dropColumn('picture');
        });
    }
}

