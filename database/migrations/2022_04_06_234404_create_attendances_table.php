<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->integer("place_id");
            $table->integer("user_id");
            $table->date("date_period");
            $table->string("shift");
            $table->time("time_start");
            $table->time("time_end");
            $table->time("time_rest")->default("00:00");
            $table->integer("actual_working_hour")->nullable()->default(0);
            $table->integer("transport_fee")->default(0);
            $table->text("note")->nullable();
            $table->integer("hourly_wage")->default(0);
            $table->integer("actual_hourly_wage")->default(0);
            $table->integer("handling_fee")->default(0);
            $table->integer("user_payment")->default(0);
            $table->integer("actual_payment")->default(0);
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
        Schema::dropIfExists('attendances');
    }
}
