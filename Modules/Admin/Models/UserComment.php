<?php

namespace Modules\Admin\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;


/**
 * Class UserComment
 * @package Modules\Admin\Models
 * Пользователи комментируют ведущих
 */
class UserComment extends Model
{
    protected $table = 'users_comments';
    protected $fillable = ['user_id', 'author_id', 'good', 'rating', 'title', 'comment', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
