<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_sites', function (Blueprint $table) {
            $table->increments('assign_site_id');
            $table->string('assign_date',50);
            $table->string('reference_no',50);
            $table->integer('contact_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->integer('site_id')->unsigned();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->foreign('contact_id')->references('contact_id')->on('contacts');
            $table->foreign('project_id')->references('project_id')->on('projects');
            $table->foreign('site_id')->references('site_id')->on('sites');
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
        Schema::dropIfExists('assign_sites');
    }
}
