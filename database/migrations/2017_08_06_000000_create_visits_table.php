<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unit', 2);
            $table->date('dt');
            $table->bigInteger('dt_unix')->nullable(true);
            $table->string('month_year', 16)->nullable(true);
            $table->time('tm');
            $table->bigInteger('tm_unix')->nullable(true);
            $table->integer('profile_id')->unsigned();
            $table->integer('origin_id')->unsigned();
            $table->decimal('avg', 5, 2);
            $table->decimal('max', 5, 2);
            $table->decimal('min', 5, 2);
            $table->decimal('prec', 5, 2);
            $table->text('comment')->nullable(true);
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('origin_id')->references('id')->on('origins');
            // $table->foreign('profile_id')->references('id')->on('profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
}
