<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $video_courses = false;
        $profile = auth()->user()->profile;
        if ($profile){
            $video_courses = $profile->video_courses;
        }
        if (!$video_courses)
            $video_courses = '[]';
        return view('pages.cabinet.video.index', ['video_courses' => $video_courses]);
    }


    public function store(Request $request)
    {
        $request->validate([
            "video_url"   => "sometimes|nullable|array",
            "video_url.*" => "sometimes|nullable|regex:/(.+youtu\.?be.+)/i",
            'video_title' => 'sometimes|nullable|array',
            'video_title.*' => 'sometimes|nullable|regex:/[\w\s\_\-0-9]*/i'
        ]);

        if ($request->has('video_url') and $request->input('video_url')) {
            $user = User::with('profile')->where('id', auth()->id())->first();
            $cleared_urls = [];

            $urls = (array)json_decode($user->profile->video_courses) ?? [];
            foreach ($request->input('video_url') as $key => $url) {
                $id = get_id_youtube_from_url($url);
                if ($id){
                    $item['url'] = $id;
                    if ($request->has('video_title') and isset($request->input('video_title')[$key])){
                        $item['title'] = $request->input('video_title')[$key];
                    }
                    $cleared_urls[] = $item;
                }
                $id = false;
            }
            $new_urls = array_merge($urls, $cleared_urls);
            $user->profile->video_courses = json_encode($new_urls, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

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
                if ($request->input('video_url') == $url->url) {
                    unset($urls[$key]);
                }
            }
            $user->profile->video_courses = json_encode($urls, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
            $user->profile->save();
        }
        return redirect()->back();
    }
}
