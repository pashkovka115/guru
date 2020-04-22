<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class ToursTags extends Model
{
    protected $table = 'tours_tags';
    protected $fillable = ['tag'];


    /*
     * у тегов много туров
     */
    public function tours()
    {
        return $this->belongsToMany(
            Tour::class,
            'tours_tags_tours',
            'tour_tag_id',
            'tour_id'
        );
    }
}
