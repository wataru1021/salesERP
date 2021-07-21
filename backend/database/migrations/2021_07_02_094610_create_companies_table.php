<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment('企業名');
            $table->string('manager_name', 255)->comment('担当者名');
            $table->string('postal_code', 255)->comment('郵便番号');
            $table->string('prefecture_id', 255)->comment('都道府県ID');
            $table->string('address1', 255)->comment('市区町村');
            $table->string('address2', 255)->comment('番地')->nullable();
            $table->string('building_name', 255)->comment('物件名、部屋番号')->nullable();
            $table->string('tel', 255)->comment('電話番号')->nullable();
            $table->tinyInteger('status')->default(1)->comment('ステータス（0:無効、1:有効）')->nullable();
            $table->tinyInteger('plan_id')->default(1)->comment('プランID')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
