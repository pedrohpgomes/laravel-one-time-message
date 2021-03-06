<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('send_from',50);
            $table->string('send_to',50);
            $table->string('message',250);
            $table->string('purl_confirmation',100);
            $table->dateTime('purl_confirmation_sent',0)->nullable();
            $table->string('purl_read',100)->nullable();
            $table->dateTime('purl_read_sent',0)->nullable();
            $table->dateTime('message_readed',0)->nullable();
        });
    }//function

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }//function

}//class
