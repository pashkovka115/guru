<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AjaxController extends Controller
{
    public function remove_variant_tour($id)
    {
        return \DB::table('tours_variants')->where('id', $id)->delete();
    }


    public function remove_img_gallery_author(Request $request)
    {
        $user = User::with('profile')->where('id', $request->input('id'))->first();
        $gallery = json_decode($user->profile->gallery);
//        return [$request->input('url'), $gallery];
        $key = array_search($request->input('url'), $gallery);

        if($key !== FALSE){
            unset($gallery[$key]);
            $new_gall = '[';
            foreach ($gallery as $item){
                $new_gall .= '"' . $item . '",';
            }
            $new_gall = rtrim($new_gall, ',') . ']';

            $user->profile->gallery = $new_gall;
            $user->profile->save();
            return 'deleted';
        }

        return false;
    }
}
