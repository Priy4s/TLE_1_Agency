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
        Schema::create('requirements', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('job_id');
            $table->string('belongsTo');
            $table->boolean('drivers_license');
            $table->boolean('walking');
            $table->boolean('hands');
            $table->boolean('standing');
            $table->boolean('talking');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requirements');
    }
};
