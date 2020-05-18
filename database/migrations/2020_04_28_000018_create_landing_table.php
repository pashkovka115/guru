<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingTable extends Migration
{
    public $tableName = 'landing';
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->enum('post_type', ['header', 'post', 'decorative', 'progress', 'content']);
            $table->integer('sort')->default(0);
//            $table->integer('sort_block')->default(0);
            $table->string('title')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('img')->nullable();
            $table->string('button_text')->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
