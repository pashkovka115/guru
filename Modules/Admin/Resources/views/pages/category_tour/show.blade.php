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
                                <input type="text" class="form-control" id="name" name="title"
                                       value="{{ $category->title }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="img">Изображение</label>
                                <img id="img" src="{{ $category->img }}" alt="">
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.category_tour.edit', ['category_tour' => $category->id]) }}" class="btn btn-primary">Редактировать</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

