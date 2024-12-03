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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->integer('id');
            $table->string('position');
            $table->text('description');
            $table->integer('length');
            $table->integer('hours');
            $table->integer('minutes');
            $table->decimal('salary');
            $table->string('type');
            $table->integer('location_id');
            $table->string('location');
            $table->text('image');
            $table->string('video');
            $table->integer('company_id');
            $table->string('company');
            $table->boolean('needed');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
