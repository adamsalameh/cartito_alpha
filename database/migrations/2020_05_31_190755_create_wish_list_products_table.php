<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishListProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wish_list_products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wish_list_id');
            $table->unsignedInteger('product_id');
            $table->timestamps();
            $table->foreign('wish_list_id')->references('id')->on('wish_lists')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wish_list_products');
    }
}
