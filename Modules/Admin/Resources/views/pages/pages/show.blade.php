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
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ $page->title }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="content">Статья</label>
                                <textarea rows="7" id="content" style="width: 100%" name="content" disabled>{{ $page->content }}</textarea>
                            </div>


                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.page.edit', ['page' => $page->id]) }}" class="btn btn-primary">Редактировать</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

