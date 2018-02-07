<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalllogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calllogs', function (Blueprint $table) {
            $table->increments('calllog_id');
            $table->integer('contact_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('note')->nullable();
            $table->datetime('call_log');
            $table->datetime('followup_date');
            $table->string('reference_type',50);
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->foreign('contact_id')->references('contact_id')->on('contacts');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->string('status',50)->default('Unseen');
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
        Schema::dropIfExists('calllogs');
    }
}
