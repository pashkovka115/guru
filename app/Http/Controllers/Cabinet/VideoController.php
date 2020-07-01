<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $video_courses = auth()->user()->profile->video_courses;
        if (!$video_courses)
            $video_courses = '[]';
        return view('pages.cabinet.video.index', ['video_courses' => $video_courses]);
    }


    public function store(Request $request)
    {
        $request->validate([
            "video_url"   => "sometimes|nullable|array",
            "video_url.*" => "sometimes|nullable|regex:/(.+youtu\.?be.+)/i",
        ]);

        if ($request->has('video_url') and $request->input('video_url')) {
            $user = User::with('profile')->where('id', auth()->id())->first();
            $cleared_urls = [];

            if (!$user->profile->video_courses) {
                foreach ($request->input('video_url') as $url) {
                    $id = get_id_youtube_from_url($url);
                    if ($id){
                        $cleared_urls[] = $id;
                    }
                    $id = false;
                }
                $user->profile->video_courses = json_encode($cleared_urls, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
            } else {
                $urls = json_decode($user->profile->video_courses) ?? [];
                foreach ($request->input('video_url') as $url) {
                    $id = get_id_youtube_from_url($url);
                    if ($id){
                        $cleared_urls[] = $id;
                    }
                    $id = false;
                }
                $new_urls = array_merge($urls, $cleared_urls);
                $user->profile->video_courses = json_encode($new_urls, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
            }

            $user->profile->save();
        }

        return redirect()->back();
    }


    public function update(Request $request, $id)
    {
        $user = User::with('profile')->where('id', auth()->id())->first();
        if ($user->profile->video_courses) {
            $urls = (array)json_decode($user->profile->video_courses) ?? [];
            foreach ($urls as $key => $url) {
                if ($request->input('old_link') == $url) {
                    $urls[$key] = $request->input('video_url');
                    break;
                }
            }
            $user->profile->video_courses = json_encode($urls, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
            $user->profile->save();
        }
        return redirect()->back();
    }


    public function destroy(Request $request, $id)
    {
        $user = User::with('profile')->where('id', auth()->id())->first();
        if ($user->profile->video_courses) {
            $urls = (array)json_decode($user->profile->video_courses) ?? [];
            foreach ($urls as $key => $url) {
                if ($request->input('video_url') == $url) {
                    unset($urls[$key]);
                }
            }
            $user->profile->video_courses = json_encode($urls, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
            $user->profile->save();
        }
        return redirect()->back();
    }
}
