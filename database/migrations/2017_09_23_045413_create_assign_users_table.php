<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_users', function (Blueprint $table) {
            $table->increments('assign_id');
            $table->integer('user_id')->unsigned();
            $table->integer('contact_id')->unsigned();
            $table->string('assign_date',50);
            $table->text('note')->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->foreign('user_id')->references('user_id')->on('users');
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
        Schema::dropIfExists('assign_users');
    }
}
