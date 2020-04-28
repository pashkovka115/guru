<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class LandingBloks extends Model
{
    protected $table = 'landing_blocks';
    public $timestamps = false;
    protected $fillable = ['sort', 'block_name', 'title', 'img'];


    /*
     * Части лендинга групируются по этим блокам
     */
    public function parts()
    {
        return $this->hasMany(Landing::class, 'block_id')->orderBy('sort');
    }
}
