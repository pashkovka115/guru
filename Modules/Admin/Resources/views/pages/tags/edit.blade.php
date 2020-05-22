@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form" action="{{ route('admin.tour.tags.update', ['tag'=>$tag->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">

                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control" id="tag" name="tag"
                                       value="{{ $tag->tag }}" required>
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
