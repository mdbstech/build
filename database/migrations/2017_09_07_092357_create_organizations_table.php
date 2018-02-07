<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('org_id');
            $table->string('org_code',50);
            $table->string('org_name',50);
            $table->string('industry',50);
            $table->string('address1',255);
            $table->string('address2',255)->nullable();
            $table->string('city',50);
            $table->string('state',50);
            $table->string('country',50);
            $table->string('mobile_no',10);
            $table->string('phone_no',50)->nullable();
            $table->string('email',50)->nullable();
            $table->string('fiscal_year',50);
            $table->string('gstin_no',50)->nullable();
            $table->string('pan_no',50)->nullable();
            $table->string('cin_no',50)->nullable();
            $table->string('tin_no',50)->nullable();
            $table->string('cst_no',50)->nullable();
            $table->string('state_code',50);
            $table->string('logo',50)->default('logo.png')->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();
        });

        DB::table('organizations')->insert(
            [
                [
                    'org_code' => 'MDBS',
                    'org_name' => 'MDBS Tech Private Limited',
                    'industry' => 'contact@mdbstech.com',
                    'address1' => 'Kalidasa Road',
                    'address2' => 'V.V. Mohalla',
                    'city' => 'Mysore',
                    'state' => 'Karnataka',
                    'country' => 'India',
                    'mobile_no' => '9538209143',
                    'phone_no' => '9538209143',
                    'email' => 'India',
                    'fiscal_year' => '2016-17',
                    'gstin_no' => '',
                    'pan_no' =>'',
                    'cin_no' => '',
                    'tin_no' => '',
                    'cst_no' => '',
                    'state_code' => '29',
                    'logo' => '',
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
        Schema::dropIfExists('organizations');
    }
}
