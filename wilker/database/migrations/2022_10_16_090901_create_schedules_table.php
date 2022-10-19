<?php

use App\Models\Place;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->enum('object', ['bus', 'train']);
            $table->string('line');
            $table->bigInteger('from_place_id')->unsigned(); 
            $table->bigInteger('to_place_id')->unsigned();
            $table->foreign('from_place_id')->references('id')->on('places');
            $table->foreign('to_place_id')->references('id')->on('places');
            $table->string('departure_time');
            $table->string('arrival_time');
            $table->integer('distance');
            $table->integer('speed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
        
    }
};
