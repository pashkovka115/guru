@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form" action="{{ route('admin.landing.update', ['landing' => 0]) }}" method="post">
                        @csrf
                        @method('PUT')
                            @isset($landing[0])
                            <div class="card-header" style="background-color: #00b3ff"><h3 class="card-title">Шапка</h3></div>
                                <div class="card-body">
                                    <?php
                                    $block = $landing[0]->parts[0] ?? false;
                                    ?>
                                        <div class="form-group">
                                            <label>H1</label>
                                            <input type="text" class="form-control" name="landing[landid_{{$landing[0]->id}}][blockid_{{$block->id}}][title]" value="{{ $block->title }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Текст в шапке</label>
                                            <textarea name="landing[landid_{{$landing[0]->id}}][blockid_{{$block->id}}][content]" class="form-control" rows="3">{{ $block->content }}</textarea>
                                        </div>
                                </div>
                        @endisset

                            @isset($landing[1])
                                    <div class="card-header" style="background-color: #00b3ff"><h3 class="card-title">Записи</h3></div>
                                    <div class="card-body">
                                    <?php
                                    $block = $landing[1]->parts ?? false;
                                    ?>
                                @foreach($block as $elem)
                                    <div class="form-group">
                                        <label>Заголовок {{ $loop->iteration }}</label>
                                        <input name="landing[landid_{{$landing[1]->id}}][blockid_{{$elem->id}}][title]" type="text" class="form-control" value="{{ $elem->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Картинка {{ $loop->iteration }}</label>
                                        <input name="landing[landid_{{$landing[1]->id}}][blockid_{{$elem->id}}][img]" type="text" class="form-control" value="{{ $elem->img }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Текст {{ $loop->iteration }}</label>
                                        <textarea name="landing[landid_{{$landing[1]->id}}][blockid_{{$elem->id}}][content]" class="form-control" rows="3">{{ $elem->content }}</textarea>
                                    </div>
                                @endforeach
                                    </div>
                            @endisset
                            @isset($landing[2])
                                    <div class="card-header" style="background-color: #00b3ff"><h3 class="card-title">Декаративный блок</h3></div>
                                    <div class="card-body">
                                        <?php
                                        $block = $landing[2]->parts[0] ?? false;
                                        ?>
                                        <div class="form-group">
                                            <label>Заголовок</label>
                                            <input name="landing[landid_{{$landing[2]->id}}][blockid_{{$block->id}}][title]" type="text" class="form-control" value="{{ $block->title }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Текст</label>
                                            <textarea name="landing[landid_{{$landing[2]->id}}][blockid_{{$block->id}}][content]" class="form-control" rows="3">{{ $block->content }}</textarea>
                                        </div>
                                    </div>
                            @endisset
                            @isset($landing[3])
                                    <div class="card-header" style="background-color: #00b3ff"><h3 class="card-title">Отличия</h3></div>
                                    <div class="card-body">
                                        <?php
                                        $block = $landing[3]->parts ?? false;
                                        ?>
                                            <div class="form-group">
                                                <label>Заголовок блока</label>
                                                <input name="landing[landid_{{$landing[3]->id}}][title]" type="text" class="form-control" value="{{ $landing[3]->title }}">
                                            </div>
                                        @foreach($block as $elem)
                                            <div class="form-group">
                                                <label>Заголовок {{ $loop->iteration }}</label>
                                                <input name="landing[landid_{{$landing[3]->id}}][blockid_{{$elem->id}}][title]" type="text" class="form-control" value="{{ $elem->title }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Текст {{ $loop->iteration }}</label>
                                                <textarea name="landing[landid_{{$landing[3]->id}}][blockid_{{$elem->id}}][content]" class="form-control" rows="3">{{ $elem->content }}</textarea>
                                            </div>
                                        @endforeach
                                    </div>
                            @endisset
                            @isset($landing[4])
                                    <div class="card-header" style="background-color: #00b3ff"><h3 class="card-title">Произвольный текст</h3></div>
                                    <div class="card-body">
                                        <?php
                                        $block = $landing[4]->parts[0] ?? false;
                                        ?>
                                        <div class="form-group">
                                            <label>Заголовок блока</label>
                                            <input name="landing[landid_{{$landing[4]->id}}][title]" type="text" class="form-control" value="{{ $landing[4]->title }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Текст</label>
                                            <textarea name="landing[landid_{{$landing[4]->id}}][blockid_{{$block->id}}][content]" row="10" id="editor1" class="form-control" rows="3">{{ $block->content }}</textarea>
                                        </div>

                                    </div>
                            @endisset


                        <div class="card-footer">
                            <button class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('editor1', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});
    </script>
@endsection
