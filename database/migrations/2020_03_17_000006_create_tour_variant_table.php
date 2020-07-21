<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourVariantTable extends Migration
{
    public $tableName = 'tours_variants';


    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tour_id');
            $table->unsignedInteger('price_variant')->nullable();
            $table->timestamp('date_start_variant')->nullable();
            $table->timestamp('date_end_variant')->nullable();
            $table->string('photo_variant')->nullable();
            $table->text('text_variant')->nullable();
            $table->integer('amount_variant')->comment('Размер группы');
            $table->integer('signed_up')->default(0)->comment('число подписавшихся');
        });

        Schema::table($this->tableName, function (Blueprint $table){
            $table->index(["tour_id"], 'fk_tour_variant_tour_idx');

            $table->foreign('tour_id', 'fk_tour_variant_tour_idx')
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
