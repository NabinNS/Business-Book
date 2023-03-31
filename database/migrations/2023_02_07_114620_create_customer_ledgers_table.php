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
        Schema::create('customer_ledgers', function (Blueprint $table) {
            $table->increments('customerledger_id');
            $table->date('date');
            $table->integer('receipt_no')->nullable();
            $table->string('particulars');
            $table->float('debit')->nullable();
            $table->float('credit')->nullable();
            $table->string('cheque_status')->nullable();
            $table->string('bill_status')->nullable();
            $table->unsignedInteger('customer_detail_id');
            $table->foreign('customer_detail_id')->references('id')->on('customer_details')->onDelete('cascade');
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
        Schema::dropIfExists('customer_ledgers');
    }
};
