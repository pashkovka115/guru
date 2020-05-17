<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTagsTable extends Migration
{
    /**
     теги туров
     */
    public function up()
    {
        Schema::create('tours_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tag');
        });
    }


    public function down()
    {
        Schema::dropIfExists('tours_tags');
    }
}
