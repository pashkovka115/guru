<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Landing extends Model
{
    protected $table = 'landing';
    public $timestamps = false;
    protected $fillable = ['post_type', 'block_id', 'sort_block', 'sort', 'title', 'img', 'excerpt', 'content', 'button_text'];


    /*
     * поля выводятся в эти блоки
     */
    /*public function blocks()
    {
        return $this->belongsTo(LandingBloks::class, 'block_id', 'id');
    }*/
}
