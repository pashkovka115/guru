@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Заголовок</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" disabled>
                            </div>

{{--                            <div class="form-group">--}}
{{--                                <label>Категория</label>--}}
{{--                                <select class="form-control" name="category_post_id" disabled>--}}
{{--                                    <option>{{ $post->category->title }}</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}

                            <div class="form-group">
                                <label>Пользователь</label>
                                <select class="form-control" name="user_id" disabled>
                                    <option>{{ $post->user->name }}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="excerpt">Краткое описание</label>
                                <textarea rows="5" style="width: 100%" id="excerpt" name="excerpt" disabled>{{ $post->excerpt }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="content">Полная запись</label>
                                <textarea rows="7" style="width: 100%" id="content" name="content" disabled>{{ $post->content }}</textarea>
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.post.edit', ['post'=>$post->id]) }}" class="btn btn-primary">Редактировать</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
