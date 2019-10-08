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
            $table->string('username')->unique()->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('avatar')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->integer('nationality_id')->nullable();
            $table->string('password')->nullable();
            $table->boolean('active')->default(1);
            $table->rememberToken();
            $table->boolean('reset_pass')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Creates password reminders table
        Schema::create('password_reminders', function ($table) {
            $table->string('email');
            $table->string('token');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('password_reminders');
        Schema::dropIfExists('users');
    }
}
