<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateTourLeaderTable
 * У мероприятия(тура) много ведущих(авторов)
 */
class CreateTourLeaderTable extends Migration
{
    public $tableName = 'tour_leader';
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tour_id');
            $table->unsignedBigInteger('leader_id');
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index(["tour_id"], 'fk_tour_leader_tour_idx');
            $table->index(["leader_id"], 'fk_tour_leader_leader_idx');

            $table->foreign('tour_id', 'fk_tour_leader_tour_idx')
                ->references('id')->on('tours')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('leader_id', 'fk_tour_leader_leader_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists($this->tableName);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
