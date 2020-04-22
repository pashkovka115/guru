@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form" action="{{ route('admin.post.update', ['post'=>$post->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Заголовок</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
                            </div>

                            <div class="form-group">
                                <label>Категория</label>
                                <select class="form-control" name="category_post_id">
                                    @foreach($categories as $category)
                                        @php
                                            if ($category->id == $post->category->id){$selected = ' selected';}
                                                else{$selected = '';}
                                        @endphp
                                        <option value="{{ $category->id }}"{{ $selected }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Пользователь</label>
                                <select class="form-control" name="user_id" required>
                                    <option></option>
                                    @foreach($users as $user)
                                        @php
                                            if ($user->id == $post->user->id){$selected = ' selected';}
                                                else{$selected = '';}
                                        @endphp
                                        <option value="{{ $user->id }}"{{$selected}}>{{ $user->name }} - {{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="excerpt">Краткое описание</label>
                                <textarea rows="5" style="width: 100%" id="excerpt" name="excerpt">{{ $post->excerpt }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="content">Полная запись</label>
                                <textarea rows="7" style="width: 100%" id="content" name="content">{{ $post->content }}</textarea>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('content', {
            filebrowserImageBrowseUrl: '/file-manager/ckeditor',
            height: 300
        });
    </script>
@endsection
