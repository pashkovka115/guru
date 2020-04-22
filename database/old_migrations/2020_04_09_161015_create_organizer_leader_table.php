<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizerLeaderTable extends Migration
{
    public $tableName = 'organizer_leader';


    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('leader_id');
            $table->unsignedBigInteger('organizer_id');
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index(["leader_id"], 'fk_organizer_leader_leader_idx');
            $table->index(["organizer_id"], 'fk_organizer_leader_organizer_idx');

            $table->foreign('leader_id', 'fk_organizer_leader_leader_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('organizer_id', 'fk_organizer_leader_organizer_idx')
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
