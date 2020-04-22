<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryTours extends Migration
{
    public $tableName = 'category_tours';

    /**
     * Категории мероприятий
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('img')->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
