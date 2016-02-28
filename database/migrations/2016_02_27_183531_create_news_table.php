<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
           $table->increments('news_id');
            $table->string('title')->unique();
            $table->longtext('body');
            $table->string('image');
            $table->boolean('status')->default();
            $table->integer('create_by')->unsigned();
            $table->foreign('create_by')->references('user_id')->on('users');
            $table->boolean('by_admin')->default(0);
            $table->integer('edit_by')->unsigned()->nullable();
            $table->foreign('edit_by')->references('user_id')->on('users');
            $table->integer('category_type')->unsigned();
            $table->foreign('category_type')->references('category_id')->on('category');
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
        Schema::drop('news');
    }
}
