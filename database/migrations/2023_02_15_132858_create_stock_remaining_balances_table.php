<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_remaining_balances', function (Blueprint $table) {
            $table->increments('stockbalance_id');
            $table->date('date');
            $table->integer('quantity');
            $table->unsignedInteger('stock_detail_id');
            $table->foreign('stock_detail_id')->references('id')->on('stock_details')->onDelete('cascade');
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
        Schema::dropIfExists('stock_remaining_balances');
    }
};
