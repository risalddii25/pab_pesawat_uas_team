<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
        $table->id();
        $table->bigInteger('flight_id');
        $table->string('flight_number');
        $table->string('departure');
        $table->string('destination');
        $table->dateTime('departure_time');
        $table->dateTime('arrival_time');
        $table->decimal('price', 8, 2);
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
        Schema::dropIfExists('flights');
    }
};
