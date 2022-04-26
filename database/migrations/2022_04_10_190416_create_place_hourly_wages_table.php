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
            $table->integer("morning_wage")->default(0);
            $table->integer("noon_wage")->default(0);
            $table->integer("night_wage")->default(0);
            $table->integer("night_overtime_wage")->default(0);
            $table->integer("overtime_wage")->default(0);
            $table->integer("holiday_wage")->default(0);
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
