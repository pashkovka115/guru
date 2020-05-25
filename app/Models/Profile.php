<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'raiting',
        'auth',
        'request',
        'url',
        'avatar',
        'excerpt',
        'description',
        'gallery',
        'address',
        'street',
        'house',
        'region',
        'city',
        'country',
        'latitude',
        'longitude',
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
