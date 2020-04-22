<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'leader_id',
        'name',
        'email',
        'phone',
        'message',
        'created_at',
        'updated_at'
    ];
}
