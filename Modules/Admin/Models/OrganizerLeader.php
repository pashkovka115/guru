<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

/*
 * ведущии - организаторы (многие ко многим)
 */
class OrganizerLeader extends Model
{
    protected $table = 'organizer_leader';
    protected $fillable = ['organizer_id', 'leader_id'];
    public $timestamps = false;
}
