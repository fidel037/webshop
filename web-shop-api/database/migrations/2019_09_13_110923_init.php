<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Init extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->decimal('price');
            $table->timestamps();
        });
        Schema::create('orders', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('item_id');
            $table->tinyInteger('payed')->default(0);
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->foreign('item_id')
                ->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
        Schema::drop('orders');
    }
}
