<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->string('product_name');
            $table->string('product_trademark');
            $table->bigInteger('product_type_id')->unsigned();
            $table->string('product_description');
            $table->string('product_price');
            $table->string('product_image_name')->nullable();
            $table->string('product_state');
            $table->timestamps();

            $table->foreign('product_type_id')->references('product_type_id')->on('product_types')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
