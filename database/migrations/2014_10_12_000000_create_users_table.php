<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('username',50);
            $table->string('name',50);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('user_role',50);
            $table->string('mobile_no',10);
            $table->string('phone_no',50)->nullable();
            $table->string('address1',255);
            $table->string('address2',255)->nullable();
            $table->string('city',50);
            $table->string('state',50);
            $table->string('country',50)->default('India');
            $table->string('zipcode',50);
            $table->string('avatar',500)->default('avatar.png')->nullable();
            $table->boolean('user_status',50)->default(1);
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            [
                [
                    'name' => 'MDBSTECH Private Limited',
                    'username' => 'mdbstech',
                    'email' => 'contact@mdbstech.com',
                    'password' => Hash::make('qwerty'),
                    'user_role' => 'Super Admin',
                    'mobile_no' => '9538209143',
                    'phone_no' => '9538209143',
                    'address1' => 'Mysore',
                    'address2' => 'Mysore',
                    'city' => 'Mysore',
                    'country' => 'India',
                    'state' => 'Karnataka',
                    'zipcode' => '570023',
                    'user_status' => 1,
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
