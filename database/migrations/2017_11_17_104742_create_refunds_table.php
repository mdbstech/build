<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->increments('refund_id');
            $table->integer('contact_id')->unsigned();
            $table->integer('site_allotment_id')->unsigned();
            $table->string('voucher_no',50);
            $table->date('voucher_date');
            $table->string('payment_mode',50);
            $table->date('date')->nullable();
            $table->string('num',50)->nullable();
            $table->double('amount',15,2);
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->foreign('contact_id')->references('contact_id')->on('contacts');
            $table->foreign('site_allotment_id')->references('site_allotment_id')->on('site_allotments');
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
        Schema::dropIfExists('refunds');
    }
}
