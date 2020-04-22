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
            <div class="col-lg-12">{{ $post->content }}</div>
        </div>
    </div>
</div>
@endsection
