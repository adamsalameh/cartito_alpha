<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');            
            $table->unsignedInteger('user_id')->nullable()->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('telephone');
            $table->string('address');
            $table->string('post_code');
            $table->string('city');
            $table->string('country');
            $table->unsignedInteger('shipping_method_id');
            $table->string('payment_method');
            $table->float('shipping_fees');            
            $table->float('total_amount');
            $table->string('currency');
            $table->string('status');
            $table->timestamps();            
            $table->foreign('shipping_method_id')->references('id')->on('shipping_methods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
