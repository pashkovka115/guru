@extends('layouts.app')
@section('content')
    @foreach($titles as $tit)
    <div class="block_about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>{{ $tit->title }}</h1>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @foreach($contents as $content)
    <div class="block_about_info">
        <div class="container">
            <div class="row">
                {!! $content->content !!}
            </div>
        </div>
    </div>
    @endforeach
    @if($team->count() > 0)
    <div class="block_about_team">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Наша команда</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach($team as $person)
                <div class="col-lg-4 col-md-6 elem_about_team">
                    <div class="img_autor_team">
                        <img src="{{ $person->img }}" alt="" class="img-fluid">
                    </div>
                    <div class="info_autor_team">
                        <p class="name_autor">{{ $person->title }}</p>
                        <p class="position_autor">{{ $person->excerpt }}</p>
                        <p class="information_autor">{{ $person->content }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    @if($progress->count() > 0)
    <div class="block_about_us block_about_us_team">
        <div class="container">
            <div class="row">
                @foreach($progress as $prog)
                <div class="col-md-3">
                    <div class="elem__about">
                        <span class="number-about">{{ $prog->title }}</span>
                        <p class="desc-about">{{ $prog->excerpt }}</p>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    @endif
@endsection
