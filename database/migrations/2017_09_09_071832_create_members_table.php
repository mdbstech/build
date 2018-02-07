<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('member_id');
            $table->string('member_name',50);
            $table->string('membership_no',50);
            $table->string('mobile_no',10);
            $table->string('phone_no',50)->nullable();
            $table->string('email',50)->nullable();
            $table->string('gender',50);
            $table->string('dob',50);
            $table->string('relationship_type',50);
            $table->string('relationship_name',50);
            $table->string('marital_status',50)->nullable();
            $table->string('address1',255);
            $table->string('address2',255)->nullable();
            $table->string('city',50);
            $table->string('pincode',50);
            $table->string('state',50);
            $table->string('country',50);
            $table->string('nationality',50);
            $table->string('religion',50)->nullable();
            $table->string('caste',50)->nullable();
            $table->string('category', 50)->nullable();
            $table->string('occupation',50)->nullable();
            $table->string('annual_income',50)->nullable();
            $table->string('nominee', 50);
            $table->string('nominee_relationship', 50);
            $table->string('nominee_age', 50);
            $table->string('site_no',50)->nullable();
            $table->string('site_dimension',50)->nullable();
            $table->string('reference', 50);
            $table->integer('user_id')->unsigned();
            
            $table->string('image', 500)->default('image.jpg')->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
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
        Schema::dropIfExists('members');
    }
}
