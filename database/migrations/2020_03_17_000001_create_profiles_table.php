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
            $table->enum('type_user', ['leader', 'organizer']);
            $table->float('raiting')->default(0.0);
            $table->enum('auth', ['0','1'])->comment('аунтифицирован администратором');
            $table->enum('request', ['0','1'])->comment('заявка на аунтификацию');
            $table->string('url')->nullable()->comment('Ссылка на видео');
            $table->string('avatar')->nullable();
            $table->text('excerpt')->nullable()->comment('кратко о себе');
            $table->longText('description')->nullable()->comment('полностью о себе');
            $table->text('gallery')->nullable()->comment('галерея');
            $table->text('video_courses')->nullable()->comment('видео-кусы');
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->string('house')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
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
