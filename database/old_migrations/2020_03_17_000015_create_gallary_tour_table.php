<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGallaryTourTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'gallary_tour';

    /**
     * Run the migrations.
     * @table gallary_tour
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('img');
            $table->unsignedBigInteger('tours_id');
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index(["tours_id"], 'fk_gallary_tour_tours_idx');

            $table->foreign('tours_id', 'fk_gallary_tour_tours_idx')
                ->references('id')->on('tours')
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
