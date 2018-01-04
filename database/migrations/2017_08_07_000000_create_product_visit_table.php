<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVisitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_visit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('visit_id')->unsigned();
            $table->smallInteger('qtd');
            $table->double('amount', 7, 2);
            $table->timestamps();
            // $table->foreign('product_id')->references('id')->on('products');
            // $table->foreign('visit_id')->references('id')->on('visits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_visit');
    }
}
