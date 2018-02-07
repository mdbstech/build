<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('ticket_id');
            $table->string('ticket_no',50);
            $table->date('ticket_date');
            $table->integer('category_id')->unsigned();
            $table->integer('priority_id')->unsigned();
            $table->integer('contact_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('status',50)->default('open');
            $table->boolean('checked')->default(0);
            $table->boolean('read_status')->default(0);
            $table->text('note')->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->foreign('category_id')->references('category_id')->on('ticket_categories');
            $table->foreign('priority_id')->references('priority_id')->on('priorities');
            $table->foreign('contact_id')->references('contact_id')->on('contacts');
            $table->foreign('user_id')->references('user_id')->on('users');
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
        Schema::dropIfExists('tickets');
    }
}
