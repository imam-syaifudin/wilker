<?php

use App\Models\User;
use App\Models\Schedule;
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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Schedule::class);
            $table->bigInteger('from_place_id')->unsigned(); 
            $table->bigInteger('to_place_id')->unsigned();
            $table->foreign('from_place_id')->references('id')->on('places');
            $table->foreign('to_place_id')->references('id')->on('places');
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
        Schema::dropIfExists('routes');
    }
};
