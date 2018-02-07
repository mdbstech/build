<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('agent_id');
            $table->string('agent_name',50);
            $table->string('agent_code',50);
            $table->string('mobile_no',50);
            $table->string('phone_no',50)->nullable();
            $table->string('email',50);
            $table->string('project_name',50);
            $table->string('customers',50);
            $table->string('call_logs',50);
            $table->string('task',50);
            $table->string('targets',50);
            $table->string('sales',50);
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
        Schema::dropIfExists('agents');
    }
}
