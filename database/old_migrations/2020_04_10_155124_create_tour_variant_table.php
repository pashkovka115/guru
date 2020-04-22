<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourVariantTable extends Migration
{
    public $tableName = 'tour_variant';


    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tour_id');
            $table->unsignedInteger('price')->nullable();
            $table->text('excerpt')->nullable();
            $table->string('img')->nullable();
            $table->string('group_people')->comment('Размер группы');
        });

        Schema::table($this->tableName, function (Blueprint $table){
            $table->index(["tour_id"], 'fk_test_tour_idx');

            $table->foreign('tour_id', 'fk_test_tour_idx')
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
