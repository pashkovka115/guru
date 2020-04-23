<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\CategoryPost;
use Modules\Admin\Models\Post;

class PostController extends Controller
{
    public $title = 'Записи';

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $posts = Post::paginate();
        return view('admin::pages.posts.index', ['posts' => $posts, 'title' => $this->title, 'title_page' => 'Список записей']);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $users = User::all();
        $categories = CategoryPost::all();
        return view('admin::pages.posts.create', ['users' => $users, 'categories' => $categories, 'title' => $this->title, 'title_page' => 'Новая запись']);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Post::create([
            'user_id' => (int)$request->input('user_id'),
            'category_post_id' => (int)$request->input('category_post_id'),
            'title' => $request->input('title'),
            'excerpt' => $request->input('excerpt'),
            'content' => $request->input('content'),
        ]);
        session()->flash('message', 'Сохранил');

        return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $post = Post::with(['user'])->where('id', $id)->first();
        return view('admin::pages.posts.show', ['post' => $post, 'title' => $this->title, 'title_page' => 'Просмотр записи']);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
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

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        Post::where('id', $id)->update([
            'user_id' => (int)$request->input('user_id'),
            'title' => $request->input('title'),
            'excerpt' => $request->input('excerpt'),
            'content' => $request->input('content'),
        ]);
        session()->flash('message', 'Обновил');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Post::where('id', $id)->first()->delete();
        session()->flash('message', 'Удалил');

        return redirect()->back();
    }
}
