<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDailyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_daily_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->length(20)->comment('ユーザーID');
            $table->date('report_date')->length(20)->comment('日報');
            $table->bigInteger('ping_pong_num')->length(20)->default(0)->comment('ピンポン数（訪問件数）');
            $table->integer('meet_num')->length(11)->default(0)->comment('対面数');
            $table->integer('deal_num')->length(11)->default(0)->comment('商談数');
            $table->integer('acquisitions_num')->length(11)->default(0)->comment('獲得数');
            $table->double('sale_time', 8, 2)->default(0)->comment('稼働時間（時間）※休憩時間は含まない');
            $table->text('conscious_point')->comment('今日意識した点');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_daily_reports');
    }
}
