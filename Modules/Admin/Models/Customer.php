<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'some_data',
        'created_at',
        'updated_at',
    ];
}
