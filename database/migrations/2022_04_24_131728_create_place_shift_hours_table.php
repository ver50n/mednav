<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceShiftHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_shift_hours', function (Blueprint $table) {
            $table->id();
            $table->integer("place_id");
            $table->string("shift");
            $table->time("start_hour");
            $table->time("end_hour");
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
        Schema::dropIfExists('place_shift_hours');
    }
}
