<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceHourlyWagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_hourly_wages', function (Blueprint $table) {
            $table->id();
            $table->integer("place_id");
            $table->string("jobtype");
            $table->float("day", 8, 2)->default(0);
            $table->float("evening", 8, 2)->default(0);
            $table->float("overnight", 8, 2)->default(0);
            $table->float("overtime_overnight", 8, 2)->default(0);
            $table->float("overtime", 8, 2)->default(0);
            $table->float("holiday", 8, 2)->default(0);
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
        Schema::dropIfExists('place_hourly_wages');
    }
}
