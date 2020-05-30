@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Адрес на сайте</th>
                                <th>Создан</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tours as $tour)
                                <tr>
                                    <td>{{ $tour->id }}</td>
                                    <td>{{ $tour->title }}</td>
                                    <td><a href="{{ route('site.catalog.tour.show', ['event' => $tour->id]) }}" target="_blank">{{ route('site.catalog.tour.show', ['event' => $tour->id]) }}</a></td>
                                    <td>{{ $tour->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    {{ $tours->links() }}
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{--    <script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>--}}
@endsection
