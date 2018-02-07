<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('project_id');
            $table->string('project_code',50);
            $table->string('project_name',50);
            $table->string('project_location',50);
            $table->string('address1',255);
            $table->string('address2',255)->nullable();
            $table->string('city',50);
            $table->string('state',50);
            $table->string('country',50);
            $table->string('no_of_sites',50);
            $table->string('project_image',500)->default('image.jpg')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
