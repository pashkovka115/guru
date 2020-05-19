<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
    public $timestamps = false;
    protected $fillable = [
        'post_type',
        'sort',
        'title',
        'excerpt',
        'content',
        'img',
        'icon',
        'url',
    ];
}

