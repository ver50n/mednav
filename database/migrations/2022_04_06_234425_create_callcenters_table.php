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
            $table->integer("actual_payment_normal_day")->default(0);
            $table->integer("actual_payment_normal_evening")->default(0);
            $table->integer("actual_payment_normal_overnight")->default(0);
            $table->integer("actual_payment_overtime_day")->default(0);
            $table->integer("actual_payment_overtime_evening")->default(0);
            $table->integer("actual_payment_overtime_overnight")->default(0);
            $table->integer("day_wage")->default(0);
            $table->integer("evening_wage")->default(0);
            $table->integer("overnight_wage")->default(0);
            $table->integer("overtime_wage")->default(0);
            $table->integer("overtime_overnight_wage")->default(0);
            $table->integer("holiday_wage")->default(0);
            $table->text("note")->nullable();
            $table->integer("transport_fee")->default(0);
            $table->integer("handling_fee")->default(0);
            $table->integer("actual_working_hour_payment")->default(0);
            $table->integer("actual_overtime_hour_payment")->default(0);
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
