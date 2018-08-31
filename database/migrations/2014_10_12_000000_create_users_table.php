<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name',20)->comment('用户名');
            $table->string('email',50)->nullable()->comment('email邮箱');
            $table->string('mobile',11)->nullable()->comment('手机号码');
            $table->string('password')->comment('密码');
            $table->string('avatar')->comment('头像地址');
            $table->boolean('is_active')->default(0)->comment('激活状态');
            $table->timestamp('deleted_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->unique(['email','mobile','name']);
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
