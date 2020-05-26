@extends('layouts.app')
@section('content')
    @if($headers)
    @foreach($headers as $header)
    <div class="block_adds" style="background: url('{{ $header->img }}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 elem_adds">
                    <h1>{{ $header->title }}</h1>
                    <p class="text_normal">{{ $header->excerpt }}</p>
                    <a href="{{ route('site.cabinet.tour.create') }}" class="btn_add">{{ $header->button_text }}</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif

    @if($posts)
    <div class="block_adds_content">
        <div class="container">
            <div class="row">
                @foreach($posts as $post)
                <div class="block_adds_content__elems">
                    <div class="col-lg-6 block_add__img">
                        <img src="{{ $post->img }}" alt="" class="img-fluid">
                    </div>
                    <div class="col-lg-6">
                        <h2>{{ $post->title }}</h2>
                        <p class="text-normal">{{ $post->excerpt }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @if($decoratives)
        @foreach($decoratives as $decorative)
    <div class="block_adds_content_bg" style="background: url('{{ $decorative->img }}');">
        <div class="container">
            <div class="row">
                <div class="block_adds_content__text">
                    <p class="text-normal">{{ $decorative->title }}</p>
                    <p class="text-normal desc-about">{{ $decorative->excerpt }}</p>
                </div>
            </div>
        </div>
    </div>
        @endforeach
    @endif

    @if($progresies)
    <div class="block_adds_content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    @isset($progresies[0])
                    <h2>{{ $progresies[0]->title }}</h2>
                        <a href="{{ route('site.cabinet.tour.create') }}" class="btn_add">{{ $progresies[0]->button_text }}</a>
                    @endisset
                </div>
            </div>
            <div class="row block_adds_content__advantage">
                @foreach($progresies as $progress)
                    @if($loop->index > 0)
                <div class="col-lg-4 col-md-6 advantage_elem">
                    <p class="title-advantage">{{ $progress->title }}</p>
                    <p class="text-normal">{{ $progress->excerpt }}</p>
                </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @if($contents)
        @foreach($contents as $content)
    <div class="block_adds_content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>{{ $content->title }}</h2>
                </div>
                {!! $content->content !!}
            </div>
        </div>
    </div>
        @endforeach
    @endif
@endsection
