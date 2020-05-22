<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class ToursTagsTours extends Model
{
    protected $table = 'tours_tags_tours';
    public $timestamps = false;
    protected $fillable = ['tour_id', 'tour_tag_id'];
}
