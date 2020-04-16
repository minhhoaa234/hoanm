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
            $table->bigIncrements('id');
            $table->string('Fullname');
            $table->text('avatar')->nullable();
            $table->string('email')->unique();
            $table->string('adress')->nullable();
            $table->boolean('Gender')->nullable();
            $table->string('Tel', 15)->nullable();
            $table->date('Birthday')->nullable();
            $table->boolean('isAdmin')->default(1);
            $table->string('password');
           
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
