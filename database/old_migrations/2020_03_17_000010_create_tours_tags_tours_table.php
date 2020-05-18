<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
туры - теги. многие ко многим
 */
class CreateToursTagsToursTable extends Migration
{
    public $tableName = 'tours_tags_tours';


    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tour_id');
            $table->unsignedBigInteger('tour_tag_id');
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index(["tour_id"], 'fk_tours_tags_tours_tour_idx');
            $table->index(["tour_tag_id"], 'fk_tours_tags_tours_tour_tag_idx');

            $table->foreign('tour_id', 'fk_tours_tags_tours_tour_idx')
                ->references('id')->on('tours')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('tour_tag_id', 'fk_tours_tags_tours_tour_tag_idx')
                ->references('id')->on('tours_tags')
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
