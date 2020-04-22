@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Категория</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $category->title }}" disabled>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.category_post.edit', ['category_post' => $category->id]) }}" class="btn btn-primary">Редактировать</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

