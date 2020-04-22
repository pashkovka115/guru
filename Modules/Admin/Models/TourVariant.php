<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class TourVariant extends Model
{
    protected $table = 'tours_variants';
    protected $fillable = ['tour_id', 'price_variant', 'photo_variant', 'text_variant', 'amount_variant', 'date_variant'];
    public $timestamps = false;
}
