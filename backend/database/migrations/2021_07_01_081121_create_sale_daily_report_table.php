<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDailyReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_daily_report', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('date')->nullable(false);
            $table->tinyInteger('status');
            $table->integer('number_ping_pong');
            $table->integer('number_meeting');
            $table->integer('number_negotiation');
            $table->integer('number_acquisition');
            $table->softDeletes();
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
        Schema::table('sale_daily_report', function (Blueprint $table) {
            $table->dropForeign('sale_daily_report_user_id_foreign');
        });

        Schema::dropIfExists('sale_daily_report');

    }
}
