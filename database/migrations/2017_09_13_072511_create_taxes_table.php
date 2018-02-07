<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->increments('tax_id');
            $table->string('tax_name',50);
            $table->double('tax_rate',15,2);
            $table->string('sgst_name',50);
            $table->double('sgst_rate',15,2);
            $table->string('cgst_name',50);
            $table->double('cgst_rate',15,2);
            $table->string('igst_name',50);
            $table->double('igst_rate',15,2);
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
        Schema::dropIfExists('taxes');
    }
}
