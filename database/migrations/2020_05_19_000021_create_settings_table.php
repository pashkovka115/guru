<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->enum('post_type', ['url', 'help']);
            $table->integer('sort')->default(0);
            $table->string('title')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('img')->nullable();
            $table->string('icon')->nullable();
            $table->string('url')->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
