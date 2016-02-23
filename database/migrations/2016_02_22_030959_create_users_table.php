<?php

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
            $table->increments('user_id');
            $table->string('firstname', 100);
            $table->string('lastname', 100);
             $table->string('contact', 100);
              $table->string('address', 100);
              $table->boolean('by_admin');
               $table->enum('gender', ['Male', 'Female']);
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('user_type', ['Admin', 'Reporter']);
             $table->enum('status', ['Active', 'Expired','Postponed','Dimissed']);
            $table->string('image') ;
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
