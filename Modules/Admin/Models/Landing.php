<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Landing extends Model
{
    protected $table = 'landing';
    public $timestamps = false;
    protected $fillable = ['block_id', 'sort', 'title', 'img', 'content'];


    /*
     * поля выводятся в эти блоки
     */
    public function blocks()
    {
        return $this->belongsTo(LandingBloks::class, 'block_id', 'id');
    }
}
