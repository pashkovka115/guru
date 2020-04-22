<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTourUserTable
 * Эти туры(мероприятия) принадлежат организатору(юзеру)
 */
class CreateTourUserTable extends Migration
{
    public $tableName = 'tour_user';


    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tour_id');
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index(["user_id"], 'fk_users_has_tours_user1_idx');
            $table->index(["tour_id"], 'fk_users_has_tours_tour1_idx');

            $table->foreign('user_id', 'fk_users_has_tours_user1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('tour_id', 'fk_users_has_tours_tour1_idx')
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
