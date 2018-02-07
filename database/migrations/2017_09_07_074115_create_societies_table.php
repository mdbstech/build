<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('societies', function (Blueprint $table) {
            $table->increments('society_id');
           $table->string('society_code',50);
            $table->string('society_name',50);
            $table->string('industry',50)->nullable();
            $table->string('address1',255);
            $table->string('address2',255)->nullable();
            $table->string('city',50);
            $table->string('state',50);
            $table->string('country',50);
            $table->string('mobile_no',10);
            $table->string('phone_no',10)->nullable();
            $table->string('email',50)->nullable();
           
            $table->string('gstin_no',50)->nullable();
            $table->string('pan_no',50)->nullable();
            $table->string('cin_no',50)->nullable();
            $table->string('tin_no',50)->nullable();
            $table->string('cst_no',50)->nullable();
           
            $table->string('logo',50)->default('logo.png')->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
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
        Schema::dropIfExists('societies');
    }
}
