<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function remove_variant_tour($id)
    {
        return \DB::table('tours_variants')->where('id', $id)->delete();
    }
}
