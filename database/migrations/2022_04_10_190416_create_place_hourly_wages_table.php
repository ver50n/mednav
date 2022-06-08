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
            $table->integer("day")->default(0);
            $table->integer("evening")->default(0);
            $table->integer("overnight")->default(0);
            $table->integer("overtime_overnight")->default(0);
            $table->integer("overtime")->default(0);
            $table->integer("holiday")->default(0);
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
