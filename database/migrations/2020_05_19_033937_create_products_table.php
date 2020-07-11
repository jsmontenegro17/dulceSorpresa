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
            $table->string('product_trademark',100);
            $table->bigInteger('product_category_id')->unsigned();
            $table->string('product_net_content',100);
            $table->string('product_flavor_color',250)->nullable();
            $table->string('product_price',100);
            $table->string('product_image_name')->nullable();
            $table->string('product_state',100);
            $table->timestamps();

            $table->foreign('product_category_id')->references('product_category_id')->on('product_categories')->onDelete('restrict')->onUpdate('restrict');
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
