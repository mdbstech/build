<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteAllotmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_allotments', function (Blueprint $table) {
            $table->increments('site_allotment_id');
            $table->integer('contact_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('site_id')->unsigned()->nullable();
            $table->date('reference_date',50);
            $table->string('reference_no',50);
            $table->string('dimension',50);
            $table->double('amount',15,2);
            $table->string('status', 50)->default('open');
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->foreign('contact_id')->references('contact_id')->on('contacts');
            $table->foreign('site_id')->references('site_id')->on('sites');
            $table->foreign('project_id')->references('project_id')->on('projects');
            $table->foreign('category_id')->references('category_id')->on('categories');
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
        Schema::dropIfExists('site_allotments');
    }
}
