<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGallaryUserTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'gallary_user';

    /**
     * Run the migrations.
     * @table gallary_user
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedBigInteger('users_id');
            $table->string('img');
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index(["users_id"], 'fk_gallary_user_users2_idx');

            $table->foreign('users_id', 'fk_gallary_user_users2_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
//        Schema::dropIfExists($this->tableName);
//        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
