<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\Post;

class PostController extends Controller
{
    public $title = 'Записи';


    public function index()
    {
        $posts = Post::paginate();
        return view('admin::pages.posts.index', ['posts' => $posts, 'title' => $this->title, 'title_page' => 'Список записей']);
    }


    public function create()
    {
        $users = User::all();

        return view('admin::pages.posts.create', ['users' => $users, 'title' => $this->title, 'title_page' => 'Новая запись']);
    }


    public function store(Request $request)
    {
        Post::create([
            'user_id' => (int)$request->input('user_id'),
            'title' => $request->input('title'),
            'img' => $request->input('img'),
            'excerpt' => $request->input('excerpt'),
            'content' => $request->input('content'),
        ]);
        session()->flash('message', 'Сохранил');

        return redirect()->back();
    }


    public function show($id)
    {
        $post = Post::with(['user'])->where('id', $id)->first();
        return view('admin::pages.posts.show', ['post' => $post, 'title' => $this->title, 'title_page' => 'Просмотр записи']);
    }


    public function edit($id)
    {
        $post = Post::with(['user'])->where('id', $id)->first();
        $users = User::all();

        return view('admin::pages.posts.edit', [
            'post' => $post,
            'users' => $users,
            'title' => $this->title,
            'title_page' => 'Редактирование записи'
        ]);
    }


    public function update(Request $request, $id)
    {
        Post::where('id', $id)->update([
            'user_id' => (int)$request->input('user_id'),
            'title' => $request->input('title'),
            'img' => $request->input('img'),
            'excerpt' => $request->input('excerpt'),
            'content' => $request->input('content'),
        ]);
        session()->flash('message', 'Обновил');

        return redirect()->back();
    }


    public function destroy($id)
    {
        Post::where('id', $id)->first()->delete();
        session()->flash('message', 'Удалил');

        return redirect()->back();
    }
}
