<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $table = 'home';
    public $timestamps = false;
    protected $fillable = ['post_type', 'sort', 'title', 'excerpt', 'content', 'img'];
}
