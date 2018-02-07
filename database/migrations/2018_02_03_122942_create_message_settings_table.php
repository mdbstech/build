<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_settings', function (Blueprint $table) {
            $table->increments('message_setting_id');
            $table->string('url',50);
            $table->string('auth_key',50);
            $table->string('promotional_route',50);
            $table->string('transactional_route',50);
            $table->string('promotional_sender',50);
            $table->string('transactional_sender',50);
            $table->string('country',50);
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();
        });
        DB::table('message_settings')->insert(
            [
                [
                    'url' => 'msg91.com',
                    'auth_key' => '1234567892',
                    'promotional_route' => '0',
                    'transactional_route' => '4',
                    'promotional_sender' => '7777777',
                    'transactional_sender' => 'mdbste',
                    'country' => 'India',
                    'created_by' => 'mdbstech',
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
        Schema::dropIfExists('message_settings');
    }
}
