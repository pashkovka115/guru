@extends('layouts.app')

@section('styles')
    @include('pages.cabinet.styles')
@endsection

@section('scripts')
    @include('pages.cabinet.scripts')
@endsection

@section('content')
    <div class="block_personal_content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('parts.cabinet.menu')
                    @if($messages->count() > 0)
                        @foreach($messages as $message)
                            <div class="message">
                                <h5>{{ $message->name }}</h5>
                                <h5>{{ $message->email }}</h5>
                                <h5>{{ $message->phone }}</h5>
                                <p>{{ $message->message }}</p>
                                <p class="date">{{ $message->created_at->formatLocalized('%e %B %Y') }}</p>
                                <form action="{{ route('site.cabinet.message.destroy', ['message' => $message->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button>Удалить</button>
                                </form>
                                <hr>
                            </div>
                        @endforeach
                    @else
                    <div class="personal_message">
                        <p class="text-normal">Здесь будут выводиться ваши сообщения:</p>
                    </div>
                    <div class="personal_status">
                        <p class="text-normal">Пока сообщений нет!</p>
                        <p class="text-normal">Как только вам напишут сообшение оно отобразиться здесь.</p>
                        <img src="{{ asset('assets/site/images/no-chats-image.svg') }}" class="no-chats-image img-fluid" alt="no message">
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
