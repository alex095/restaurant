<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('dish_id');
            $table->string('table_num');
            $table->string('waiter_id');
            $table->string('status_id');
            $table->string('time');
        });

        Schema::create('dishes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dish_name');
        });

        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
