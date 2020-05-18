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
                    <div class="personal_events">
                        <h1 class="user-title">Ведущие</h1>
                        <a href="{{ route('site.cabinet.leaders.create') }}" class="btn-personal">Добавить ведущего</a>
                    </div>
                    @foreach($user->leaders as $leader)
                        <div class="personal_status_events">
                            <div class="personal_events-public">
                                <div class="block-public">
                                    <p class="public-title">{{ $leader->name }}</p>
                                    <p class="public-date">{{ $leader->email }}</p>
                                    <p class="public-status">
                                        @php($profile = $leader->profile)
                                        {{ $profile->country ?? null }} - {{ $profile->city ?? null }}
                                    </p>
                                </div>
                            </div>
                            <div class="personal_events_btn">
                                <a href="{{ route('site.cabinet.leaders.edit', ['leader' => $leader->id]) }}" class="btn-edit">Редактировать</a>

                                <a href="{{ route('site.cabinet.leaders.destroy', ['leader' => $leader->id]) }}"
                                   onclick="event.preventDefault(); document.getElementById('delete-form{{ $loop->index }}').submit();" class="btn-edit"> Удалить
                                </a>
                                <form id="delete-form{{ $loop->index }}" action="{{ route('site.cabinet.leaders.destroy', ['leader' => $leader->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
