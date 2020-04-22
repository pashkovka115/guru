<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryToursTours extends Migration
{
    public $tableName = 'category_tour_tour';


    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_tour_id');
            $table->unsignedBigInteger('tour_id');
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index(["category_tour_id"], 'fk_category_tour_has_tour_category_tour1_idx');
            $table->index(["tour_id"], 'fk_category_tour_has_tour_tour1_idx');

            $table->foreign('category_tour_id', 'fk_category_tour_has_tour_category_tour1_idx')
                ->references('id')->on('category_tours')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('tour_id', 'fk_category_tour_has_tour_tour1_idx')
                ->references('id')->on('tours')
                ->onDelete('cascade')
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
