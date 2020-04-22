<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    public $tableName = 'pages';


    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('content')->nullable();
            $table->nullableTimestamps();
        });
    }


     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
