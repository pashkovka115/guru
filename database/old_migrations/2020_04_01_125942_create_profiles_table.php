<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    public $tableName = 'profiles';

    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->enum('type_user', ['user', 'organizer', 'leader']);
            $table->float('raiting');
            $table->enum('auth', ['0','1']);
            $table->longText('exception')->nullable();
            $table->text('description')->nullable();
            $table->string('country');
            $table->string('city');
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index(["user_id"], 'fk_profile_user_idx');

            $table->foreign('user_id', 'fk_profile_user_idx')
                ->references('id')->on('users')
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
