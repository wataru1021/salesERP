<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->length(20)->comment('ユーザーID');
            $table->string('appointee_name', 255)->comment('話した人の名前');
            $table->string('appointment_address', 255)->comment('話した人の立場');
            $table->date('appointment_date')->length(20)->comment('アポの日');
            $table->time('appointment_time')->length(20)->comment('時間帯');
            $table->text('appointment_memo')->comment('メモ');
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
        Schema::dropIfExists('appointments');
    }
}
