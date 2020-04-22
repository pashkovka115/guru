<div class="container-fluid">
    <div class="row">
        <div class="col">
            @if($errors->any())
                <ul id="errors">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            <li>{{ $error }}</li>
                        </div>
                    @endforeach
                </ul>
            @endif
            @if (session()->has('message'))
                <div class="alert alert-info" role="alert">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>
    </div>
</div>
