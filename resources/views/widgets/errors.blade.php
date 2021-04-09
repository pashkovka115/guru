@if(Route::currentRouteName() != 'login')
<div class="block-error">
    <div class="row-error">
        @if($errors->any())
        <div class="block-error__container">
            <ul id="errors" class="block-alert">
                <span class="errors__close"><svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path></svg></span>
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <li>{!! $error !!}</li>
                    </div>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session()->has('message'))
        <div class="block-error__container">
            <div class="block-alert">
                <span class="errors__close"><svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path></svg></span>
                <div class="alert alert-info" role="alert">
                    {!! session()->get('message') !!}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endif
