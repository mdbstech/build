<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->increments('income_id');
             $table->string('receipt_no',50);
            $table->date('receipt_date');
            $table->integer('income_account')->unsigned();
            $table->integer('deposit_to')->unsigned();
            $table->integer('contact_id')->unsigned();
            $table->string('payment_mode',50);
            $table->double('amount',15,2);
            $table->string('files')->default('file.jpg');
            $table->text('note')->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->foreign('income_account')->references('account_id')->on('accounts');
            $table->foreign('deposit_to')->references('account_id')->on('accounts');
            $table->foreign('contact_id')->references('contact_id')->on('contacts');
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
        Schema::dropIfExists('incomes');
    }
}
