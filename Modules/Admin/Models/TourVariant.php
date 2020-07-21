<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TourVariant extends Model
{
    protected $table = 'tours_variants';
    protected $fillable = ['tour_id', 'price_variant', 'photo_variant', 'text_variant', 'amount_variant', 'date_variant'];
    public $timestamps = false;


    public static function boot()
    {
        parent::boot();

        if (!auth()->check()){
            // todo: не показывать варианты мероприятия не авторизованным если нет свободных мест
            // клиентов не авторизуем (у них нет личного кабинета)
            static::addGlobalScope('signed_up', function (Builder $builder) {
                $builder->where('signed_up', '>', 0);
            });
        }
    }
}
