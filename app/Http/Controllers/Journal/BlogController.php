<?php

namespace App\Http\Controllers\Journal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\Post;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // из за HTML выводить кратное пяти
        $posts = Post::paginate(5);

        if ($request->ajax()){
            return view('pages.journal.ajax_response', ['posts' => $posts]);
        }else{
            return view('pages.journal.index', ['posts' => $posts]);
        }
    }


    public function show($id)
    {
        $post = Post::where('id', $id)->firstOrFail();
        return view('pages.journal.show', ['post' => $post]);
    }
}
