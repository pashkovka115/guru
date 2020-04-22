<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'content',
        'created_at',
        'updated_at',
    ];
}
