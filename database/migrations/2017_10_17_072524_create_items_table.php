<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('exchange_type'); // will be set to 'sell', 'swap' or 'part_exchange' based on radio button selected
            $table->string('item_name');
            $table->string('description');
            $table->integer('requested_price'); // will be set as null if 'swap' is set in 'exchange_type'
            $table->string('requested_item'); // will be set as null if 'sell' is set in 'exchange_type'
            $table->string('category');
            $table->string('tags'); // tags will be seperated with comma
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
        Schema::dropIfExists('items');
    }
}
