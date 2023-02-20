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
        Schema::create('stock_ledgers', function (Blueprint $table) {
            $table->increments('stockledger_id');
            $table->date('date');
            $table->string('particulars');
            $table->integer('receipt_no')->nullable();
            $table->integer('quantity');
            $table->float('rate')->nullable();
            $table->integer('issued_quantity');
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
        Schema::dropIfExists('stock_ledgers');
    }
};
