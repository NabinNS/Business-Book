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
        Schema::create('account_remaining_balances', function (Blueprint $table) {
            $table->increments('accbalance_id');
            $table->date('date');
            $table->string('company_name');
            $table->integer('amount');
            $table->unsignedInteger('company_details_id');
            $table->foreign('company_details_id')->references('id')->on('company_details');
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
        Schema::dropIfExists('account_remaining_balances');
    }
};
