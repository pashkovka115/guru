<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    public $tableName = 'posts';


    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('img')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->nullableTimestamps();
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index(["user_id"], 'fk_posts_user2_idx');

            $table->foreign('user_id', 'fk_posts_user2_idx')
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
