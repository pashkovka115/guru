<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public $tableName = 'messages';

    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leader_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->longText('message');
            $table->timestamps();
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index(["leader_id"], 'fk_messages_leader_idx');

            $table->foreign('leader_id', 'fk_messages_leader_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

        });
    }


    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists($this->tableName);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
