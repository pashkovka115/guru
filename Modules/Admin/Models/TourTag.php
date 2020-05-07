<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class TourTag extends Model
{
    protected $table = 'tours_tags';
    public $timestamps = false;
    protected $fillable = ['tag'];


    /*
    * у тегов много туров
    */
    public function tags()
    {
        return $this->belongsToMany(
            Tour::class,
            'tours_tags_tours',
            'tour_tag_id',
            'tour_id'
        );
    }
}
