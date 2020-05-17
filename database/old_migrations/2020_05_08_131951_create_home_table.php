<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeTable extends Migration
{
    public function up()
    {
        Schema::create('home', function (Blueprint $table) {
            $table->id();
            $table->enum('post_type', ['title', 'content', 'people', 'progress']);
            $table->integer('sort')->default(0);
            $table->string('title')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('img')->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists('home');
    }
}
