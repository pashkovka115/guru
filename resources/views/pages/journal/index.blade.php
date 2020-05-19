@extends('layouts.app')
@section('content')
<div class="block_journal">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Журнал новостей</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div id="load_content" class="row">
            @foreach($posts as $post)
                @if($loop->index % 5 == 0)
            <div class="col-lg-8 col-md-12">
                @else
                    <div class="col-lg-4 col-md-12">
                @endif
                <div class="elem__news elems_journal">
                    <img src="{{ $post->img }}" alt="" class="img-fluid">
                    <a href="{{ route('site.journal.blog.show', ['journal' => $post->id]) }}" class="title-news">{{ $post->title }}</a>
                    <p class="description-news">{{ mb_strimwidth($post->excerpt, 0, 100, '...') }}</p>
                </div>
            </div>
            @endforeach

                <div id="remove_el" class="col-lg-12 after-posts">
                    <button type="button" class="btn-load-more" id="btn-load-more"
                            data-next-url="{{ $posts->nextPageUrl() }}">
                        Показать еще
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts_footer')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#btn-load-more', function (e) {
                e.preventDefault();
                var next_url = $('#btn-load-more').data('next-url');
                if (next_url === '' || next_url === null){
                    $('#remove_el').remove();
                    return;
                }
                const btn = $(this);
                const loader = btn.find('span');

                $.ajax({
                    url: next_url,
                    type: 'GET',
                    beforeSend: function () {
                        btn.attr('disabled', true);
                        loader.addClass('d-inline-block');
                    },
                    success: function (response) {
                        $('#remove_el').remove();
                        $('#load_content').append(response);
                    },
                    error: function () {
                        alert('Ошибка!');
                        loader.removeClass('d-inline-block');
                        btn.attr('disabled', false);
                    }
                });
            })
        });
    </script>
@endsection
