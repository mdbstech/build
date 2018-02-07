<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('expense_id');
            $table->string('voucher_no',50);
            $table->date('voucher_date');
            $table->integer('expense_account')->unsigned();
            $table->integer('paid_through')->unsigned();
            $table->integer('contact_id')->unsigned();
            $table->string('payment_mode',50);
            $table->double('amount',15,2);
            $table->string('files')->default('file.jpg');
            $table->text('note')->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->foreign('expense_account')->references('account_id')->on('accounts');
            $table->foreign('paid_through')->references('account_id')->on('accounts');
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
        Schema::dropIfExists('expenses');
    }
}
