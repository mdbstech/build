<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('contact_id');
            $table->integer('society_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('contact_name',50);
            $table->string('membership_no',50)->nullable();
            $table->string('contact_type',50)->default('Lead');
            $table->string('contact_code',50)->nullable();
            $table->string('email',50)->nullable();
            $table->string('gender',50);
            $table->string('dob',50)->nullable();
            $table->string('relationship_type',50)->nullable();
            $table->string('relationship_name',50)->nullable();
            $table->string('mobile_no',10);
            $table->string('phone_no',50)->nullable();
            $table->string('address1',50)->nullable();
            $table->string('address2',50)->nullable();
            $table->string('marital_status',50)->nullable();
            $table->string('city',50)->nullable();
            $table->string('pincode',50)->nullable();
            $table->string('state',50)->nullable();
            $table->string('country',50)->nullable();
            $table->string('nationality',50)->nullable();
            $table->string('religion',50)->nullable();
            $table->string('caste',50)->nullable();
            $table->string('category', 50)->nullable();
            $table->string('occupation',50)->nullable();
            $table->string('annual_income',50)->nullable();
            $table->string('nominee', 50)->nullable();
            $table->string('nominee_relationship', 50)->nullable();
            $table->string('nominee_age', 50)->nullable();
            $table->string('site_no',50)->nullable();
            $table->string('site_dimension',50)->nullable();
            $table->string('reference_type', 50);
            $table->string('image', 500)->default('image.jpg')->nullable();  
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('society_id')->references('society_id')->on('societies');
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
        Schema::dropIfExists('contacts');
    }
}
