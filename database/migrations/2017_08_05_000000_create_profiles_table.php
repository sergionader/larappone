<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->integer('sort_order')->nullable(true);
            $table->integer('type_id')->unsigned();
            $table->integer('subtype_id')->unsigned();
            $table->timestamps();
            // $table->foreign('type_id')->references('id')->on('types');
            // $table->foreign('subtype_id')->references('id')->on('subtypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
