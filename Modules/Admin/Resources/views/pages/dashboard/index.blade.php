@extends('admin::layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $cnt_not_auth_users }}</h3>
                    <p>Не подтверждённых профилей пользователей</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
{{--                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $requests_auth }}</h3>
                    <p>Заявок на подтверждение статуса</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('admin.dashboard.requests') }}" class="small-box-footer">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $all_users }}</h3>
                    <p>Всего пользователей</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('admin.user.index') }}" class="small-box-footer">Все пользователи <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $all_events }}</h3>
                    <p>Всего мероприятий</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('admin.tour.index') }}" class="small-box-footer">Все мероприятия <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>
</div>
@endsection
