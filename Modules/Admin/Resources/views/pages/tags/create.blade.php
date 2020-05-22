@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form" action="{{ route('admin.tour.tags.store') }}" method="post">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control" name="tag" value="{{ old('tag') }}" required>
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
