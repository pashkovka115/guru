<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class TourLeader extends Model
{
    protected $table = 'tour_leader';
    protected $fillable = ['tour_id', 'leader_id'];
}
