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
            $table->string('mail_address', 50)->unique();
            $table->string('user_password', 60);
            $table->string('user_name', 20)->nullable();
            $table->string('user_name_hiragana', 20)->nullable();
            $table->string('telephone_number', 15)->nullable();
            $table->string('nickname', 20)->nullable();
            $table->string('token', 60);
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
        Schema::dropIfExists('users');
    }
}
