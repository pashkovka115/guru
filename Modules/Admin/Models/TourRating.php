<?php

namespace Modules\Admin\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class TourRating extends Model
{
    protected $table = 'tours_rating';
    protected $fillable = [
        'tour_id',
        'user_id',
        'title',
        'rating',
        'comment',
        'created_at',
        'updated_at'
    ];


    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }

    public function tour()
    {
        return $this->belongsTo(
            Tour::class,
            'tour_id',
            'id'
        );
    }
}
