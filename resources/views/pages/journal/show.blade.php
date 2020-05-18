@extends('layouts.app')
@section('content')
<div class="block_payment">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>{{ $post->title }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            <img src="http://a0437878.xsph.ru/assets/site/images/home_bg_new.jpg" alt="" class="img-fluid img-journal">
            <p class="text_normal">{{ $post->content }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
