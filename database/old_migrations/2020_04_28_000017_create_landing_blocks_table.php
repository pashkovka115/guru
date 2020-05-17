<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingBlocksTable extends Migration
{

    public function up()
    {
        Schema::create('landing_blocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sort')->default(1);
            $table->string('block_name'); // group by
            $table->enum('visible', ['1', '0']);
            $table->string('class')->nullable();
            $table->string('title')->nullable();
            $table->string('img')->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists('landing_blocks');
    }
}
