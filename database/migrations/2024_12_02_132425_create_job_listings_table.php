<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobListingsTable extends Migration
{
    public function up()
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->text('description');
            $table->integer('length');
            $table->integer('hours');
            $table->decimal('salary', 8, 2);
            $table->string('type');
            $table->foreignId('location_id')->constrained('locations');
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->foreignId('company_id')->constrained('companies');
            $table->boolean('needed');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_listings');
    }
}
