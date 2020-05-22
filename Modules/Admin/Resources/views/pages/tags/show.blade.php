@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">

                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control" value="{{ $tag->tag }}" disabled>
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.tour.tags.edit', ['tag' => $tag->id]) }}" class="btn btn-primary">Редактировать</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
