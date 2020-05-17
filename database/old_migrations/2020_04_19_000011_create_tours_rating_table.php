<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
 * Отзыв/Оценка о туре
 */
class CreateToursRatingTable extends Migration
{
    public $tableName = 'tours_rating';


    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->enum('new_comment', ['1', '0']);
            $table->unsignedBigInteger('tour_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('rating');
            $table->string('title');
            $table->longText('comment');
            $table->timestamps();
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index(['tour_id'], 'fk_tours_rating_tour_idx');
            $table->index(['user_id'], 'fk_tours_rating_user_idx');

            $table->foreign('tour_id', 'fk_tours_rating_tour_idx')
                ->references('id')->on('tours')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('user_id', 'fk_tours_rating_user_idx')
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
