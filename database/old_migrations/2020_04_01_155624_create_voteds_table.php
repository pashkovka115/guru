<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotedsTable extends Migration
{
    public $tableName = 'voteds';

    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('who_user_id')->comment('кто оценил');
            $table->unsignedBigInteger('for_user_id')->comment('кого оценил');
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index(["who_user_id"], 'fk_users_has_users_users1_idx');
            $table->index(["for_user_id"], 'fk_users_has_users_users2_idx');

            $table->foreign('who_user_id', 'fk_users_has_users_users1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('for_user_id', 'fk_users_has_users_users2_idx')
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
