<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallcentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('callcenters', function (Blueprint $table) {
            $table->id();
            $table->integer("place_id");
            $table->integer("user_id");
            $table->date("date_period");
            $table->string("shift");
            $table->datetime("time_start");
            $table->datetime("time_end");
            $table->datetime("actual_time_start")->nullable();
            $table->datetime("actual_time_end")->nullable();
            $table->datetime("actual_time_rest_start")->nullable();
            $table->datetime("actual_time_rest_end")->nullable();
            $table->datetime("actual_time_rest_start2")->nullable();
            $table->datetime("actual_time_rest_end2")->nullable();
            $table->time("actual_working_hour_day_shift")->default("00:00");
            $table->time("actual_working_hour_evening_shift")->default("00:00");
            $table->time("actual_working_hour_overnight_shift")->default("00:00");
            $table->time("actual_overtime_hour_day_shift")->default("00:00");
            $table->time("actual_overtime_hour_evening_shift")->default("00:00");
            $table->time("actual_overtime_hour_overnight_shift")->default("00:00");
            $table->time("actual_rest_hour_day_shift")->default("00:00");
            $table->time("actual_rest_hour_evening_shift")->default("00:00");
            $table->time("actual_rest_hour_overnight_shift")->default("00:00");
            $table->float("actual_payment_normal_day", 8, 2)->default(0);
            $table->float("actual_payment_normal_evening", 8, 2)->default(0);
            $table->float("actual_payment_normal_overnight", 8, 2)->default(0);
            $table->float("actual_payment_overtime_day", 8, 2)->default(0);
            $table->float("actual_payment_overtime_evening", 8, 2)->default(0);
            $table->float("actual_payment_overtime_overnight", 8, 2)->default(0);
            $table->float("day_wage", 8, 2)->default(0);
            $table->float("evening_wage", 8, 2)->default(0);
            $table->float("overnight_wage", 8, 2)->default(0);
            $table->float("overtime_wage", 8, 2)->default(0);
            $table->float("overtime_overnight_wage", 8, 2)->default(0);
            $table->float("holiday_wage", 8, 2)->default(0);
            $table->text("note")->nullable();
            $table->integer("transport_fee")->default(0);
            $table->float("handling_fee", 8, 2)->default(0);
            $table->float("actual_working_hour_payment", 8, 2)->default(0);
            $table->float("actual_overtime_hour_payment", 8, 2)->default(0);
            $table->integer("user_payment")->default(0);
            $table->integer("actual_payment")->default(0);
            $table->string("status")->default("draft");
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
        Schema::dropIfExists('callcenters');
    }
}
