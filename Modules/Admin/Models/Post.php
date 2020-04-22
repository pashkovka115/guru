<?php

namespace Modules\Admin\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'excerpt', 'content', 'category_post_id', 'created_at', 'updated_at'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
