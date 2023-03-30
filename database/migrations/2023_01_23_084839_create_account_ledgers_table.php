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
        Schema::create('account_ledgers', function (Blueprint $table) {
            $table->increments('acc_id');
            $table->date('date');
            $table->integer('receipt_no')->nullable();
            $table->string('particulars');
            $table->float('debit')->nullable();
            $table->float('credit')->nullable();
            $table->string('cheque_status')->nullable();
            $table->unsignedInteger('company_details_id');
            $table->foreign('company_details_id')->references('id')->on('company_details')->onDelete('cascade');
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
        Schema::dropIfExists('account_ledgers');
    }
};
