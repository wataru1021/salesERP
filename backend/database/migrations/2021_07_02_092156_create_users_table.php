<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment('ユーザー名');
            $table->bigInteger('role_id')->length(20)->comment('権限');
            $table->bigInteger('company_id')->length(20)->default(null)->comment('企業')->nullable();
            $table->string('email', 255)->comment('メールアドレス');
            $table->string('password')->comment('パスワード');
            $table->string('tel', 30)->comment('電話番号')->nullable();
            $table->tinyInteger('status')->comment('ステータス')->nullable();
            $table->dateTime('last_login_at')->comment('最終ログイン時刻')->nullable();
            $table->string('reset_password_token', 255)->nullable();
            $table->dateTime('reset_password_token_expire')->nullable();
            $table->string('remember_token', 255)->nullable();
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
        Schema::dropIfExists('users');
    }
}
