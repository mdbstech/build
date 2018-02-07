<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('site_id');
            $table->integer('project_id')->unsigned();
            $table->integer('contact_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned();
            $table->string('site_no',50);
            $table->string('site_dimension',50);
            $table->string('color',50);
            $table->text('site_description')->nullable();
            $table->boolean('status',50)->default(0);
            $table->string('created_by')->nullable();
            $table->string('updated_by',50)->nullable();
            $table->foreign('project_id')->references('project_id')->on('projects');
            $table->foreign('contact_id')->references('contact_id')->on('contacts');
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
        Schema::dropIfExists('sites');
    }
}
