@extends('layouts.app')
@section('content')
    <div class="block_help">
        <div class="container">
            @foreach($settings as $setting)
            <div class="row">
                <div class="col-lg-12">
                    <h1>{{ $setting->title }}</h1>
                    <p class="text-normal">{{ $setting->excerpt }}</p>
                </div>
                <div class="col-lg-12 block_message">
                    {!! $setting->content !!}
                    <p><a class="help_message" href="mailto:<?= env('MAIL_USERNAME') ?>">Написать в поддержку</a></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
