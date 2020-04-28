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
            $table->unsignedBigInteger('block_id');
            $table->unsignedInteger('sort')->default(1);
            $table->string('title')->nullable();
            $table->string('img')->nullable();
            $table->longText('content')->nullable();
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index(["block_id"], 'fk_landing_block_idx');

            $table->foreign('block_id', 'fk_landing_block_idx')
                ->references('id')->on('landing_blocks')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }


    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
