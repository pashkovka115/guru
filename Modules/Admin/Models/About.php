<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'about';
    public $timestamps = false;
    protected $fillable = [
        'post_type',
        'sort',
        'title',
        'excerpt',
        'content',
        'img',
    ];
}
