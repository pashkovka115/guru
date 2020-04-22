<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as R;

class Role extends R
{
    protected $fillable = ['name', 'description', 'created_at', 'updated_at', 'guard_name'];

//    public function permissions()
//    {
//
//    }
}
