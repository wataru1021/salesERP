<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnCreatedAtFromSaleDailyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale_daily_reports', function (Blueprint $table) {
            $table->timestamp('created_at')->nullable()->comment('報告時間')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sale_daily_reports', function (Blueprint $table) {
            //
        });
    }
}
