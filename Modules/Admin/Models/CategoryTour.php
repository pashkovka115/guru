<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTour extends Model
{
    protected $table = 'category_tours';
    protected $fillable = ['title', 'img', 'description'];
    public $timestamps = false;

    public function tours()
    {
        //todo: тестить
        return $this->hasMany(Tour::class, 'category_tour_id', 'id');
    }

    public function tours_with_variants()
    {
        //todo: тестить
        return $this->hasMany(Tour::class, 'category_tour_id', 'id')->with('variants');
    }
}
