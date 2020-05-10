@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form" action="{{ route('admin.page.update', ['page'=>$page->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="title">Заголовок</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                               value="{{ $page->title }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Сортировка</label>
                                        <select name="sort" class="form-control">
                                            @for($i = 0; $i < $page->count(); $i++)
                                                <?php if ($page->sort == $i) $selected = ' selected';
                                                        else
                                                            $selected = '';
                                                ?>
                                            <option value="{{ $i }}"{{ $selected }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content">Статья</label>
                                <textarea id="content" name="content">{{ $page->content }}</textarea>
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
