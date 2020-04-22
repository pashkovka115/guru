<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    public $tableName = 'discounts';

    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tour_id');
            $table->string('title');
            $table->smallInteger('percent')->default(0)->comment('процент скидки');
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index(["tour_id"], 'fk_discounts_tour_idx');

            $table->foreign('tour_id', 'fk_discounts_tour_idx')
                ->references('id')->on('tours')
                ->onDelete('no action')
                ->onUpdate('no action');

        });
    }


    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('discounts');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
