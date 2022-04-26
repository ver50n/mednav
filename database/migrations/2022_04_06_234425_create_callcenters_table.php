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
            $table->time("working_hour")->default("00:00");
            $table->datetime("actual_time_start")->nullable();
            $table->datetime("actual_time_end")->nullable();
            $table->time("actual_time_rest")->default("00:00");
            $table->time("actual_working_hour")->default("00:00");
            $table->time("actual_overtime")->default("00:00");
            $table->integer("morning_wage")->default(0);
            $table->integer("noon_wage")->default(0);
            $table->integer("night_wage")->default(0);
            $table->integer("overtime_wage")->default(0);
            $table->integer("night_overtime_wage")->default(0);
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
