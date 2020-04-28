@extends('layouts.app')
@section('content')
    @isset($landing[0])
    <div class="block_adds">
        <div class="container">
            <div class="row">
                @foreach($landing[0]->parts as $block)
                <div class="col-lg-12 elem_adds">
                    <h1>{{ $block->title ?? '' }}</h1>
                    <p class="text_normal">{{ $block->content ?? '' }}</p>
                    <a href="{{ route('site.cabinet.tour.create') }}" class="btn_add">Добавить объявление</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endisset
    @isset($landing[1])
    <div class="block_adds_content">
        <div class="container">
            <div class="row">
                @foreach($landing[1]->parts as $block)
                <div class="block_adds_content__elems">
                    <div class="col-lg-6 block_add__img">
                        <img src="{{ $block->img }}" alt="" class="img-fluid">
                    </div>
                    <div class="col-lg-6">
                        <h2>{{ $block->title }}</h2>
                        <p class="text-normal">{{ $block->content }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endisset
    @isset($landing[2])
    <div class="block_adds_content_bg">
        <div class="container">
            <div class="row">
                @foreach($landing[2]->parts as $block)
                <div class="block_adds_content__text">
                    <p class="text-normal">{{ $block->title }}</p>
                    <p class="text-normal desc-about">{{ $block->content }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endisset
    @isset($landing[3])
    <div class="block_adds_content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>{{ $landing[3]->title }}</h2>
                    <a href="{{ route('site.cabinet.tour.create') }}" class="btn_add">Добавить объявление</a>
                </div>
            </div>
            <div class="row block_adds_content__advantage">
                @foreach($landing[3]->parts as $block)
                <div class="col-lg-4 col-md-6 advantage_elem">
                    <p class="title-advantage">{{ $block->title }}</p>
                    <p class="text-normal">{{ $block->content }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endisset
    @isset($landing[4])
    <div class="block_adds_content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>{{ $landing[4]->title }}</h2>
                </div>
                @foreach($landing[4]->parts as $block)
                    {!! $block->content !!}
                @endforeach
            </div>
        </div>
    </div>
    @endisset
@endsection
