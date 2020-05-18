<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
 * Коментируем ведущих
 */
class CreateUsersCommentsTable extends Migration
{
    public $tableName = 'users_comments';

    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('кто комментировал');
            $table->unsignedBigInteger('author_id')->comment('кого комментировал');
            $table->enum('good', ['1', '0']);
            $table->tinyInteger('rating');
            $table->string('title');
            $table->longText('comment');
            $table->timestamps();
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index(["user_id"], 'fk_users_comments_user_idx');
            $table->index(["author_id"], 'fk_users_comments_author_idx');

            $table->foreign('user_id', 'fk_users_comments_user_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('author_id', 'fk_users_comments_author_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists($this->tableName);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
