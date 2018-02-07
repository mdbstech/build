<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('account_id');
            $table->integer('account_type_id')->unsigned();
            $table->string('account_code',50);
            $table->string('account_name',50);
            $table->string('account_no',50)->nullable();
            $table->string('bank_name',50)->nullable();
            $table->string('branch_name',50)->nullable();
            $table->string('ifsc_code',50)->nullable();
            $table->text('account_description')->nullable();
            $table->boolean('account_status')->default(1);
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            
            $table->foreign('account_type_id')->references('account_type_id')->on('account_types');
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
        Schema::dropIfExists('accounts');
    }
}
