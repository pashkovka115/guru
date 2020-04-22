<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'posts';

    /**
     * Run the migrations.
     * @table posts
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('category_post_id');
            $table->nullableTimestamps();
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index(["category_post_id"], 'fk_posts_category_post1_idx');
            $table->index(["user_id"], 'fk_posts_user2_idx');

            $table->foreign('user_id', 'fk_posts_user2_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('category_post_id', 'fk_posts_category_post1_idx')
                ->references('id')->on('category_posts')
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
