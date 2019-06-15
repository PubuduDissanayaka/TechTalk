<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('value');
            $table->string('star_status');
            $table->text('feedback')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('rating_user_id')->unsigned();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rating_user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_ratings');
    }
}
