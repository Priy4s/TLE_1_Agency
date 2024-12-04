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
            $table->bigIncrements('id');
            $table->string('position');
            $table->text('description');
            $table->integer('length');
            $table->integer('hours');
            $table->decimal('salary');
            $table->string('type');
            $table->integer('location_id');
            $table->text('image')->nullable();
            $table->string('video')->nullable();
            $table->integer('company_id');
            $table->boolean('needed')->default(false);
            $table->boolean('driverslicense')->default(false);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
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
