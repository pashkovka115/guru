<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserSubscribeTour extends Migration
{
    public $tableName = 'user_subscribe_tour';


    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('users_id');
            $table->unsignedBigInteger('tours_id');
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index(["tours_id"], 'fk_users_has_tours_tours2_idx');
            $table->index(["users_id"], 'fk_users_has_tours_users2_idx');

            $table->foreign('users_id', 'fk_users_has_tours_users2_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('tours_id', 'fk_users_has_tours_tours2_idx')
                ->references('id')->on('tours')
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
