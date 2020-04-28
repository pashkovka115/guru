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
        <div class="row">
            @foreach($posts as $post)
                @if($loop->index % 5 == 0)
            <div class="col-lg-8 col-md-12">
                @else
                    <div class="col-lg-4 col-md-12">
                @endif
                <div class="elem__news elems_journal">
                    <img src="{{ $post->img }}" alt="" class="img-fluid">
                    <a href="{{ route('site.journal.blog.show', ['journal' => $post->id]) }}" class="title-news">{{ $post->title }}</a>
                    <p class="description-news">{{ $post->excerpt }}</p>
                </div>
            </div>
            @endforeach
                <script> var next_url_page = '{{ $posts->nextPageUrl() }}'</script>

                    <div class="col-lg-12 after-posts">
                        <button type="button" class="btn-load-more">
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
        $(function() {
            $('.btn-load-more').on('click', function(){
                const btn = $(this);
                const loader = btn.find('span');
                if(next_url_page === ''){
                    $('.after-posts').hide();
                    return;
                }
                $.ajax({
                    url: next_url_page,
                    type: 'GET',
                    beforeSend: function(){
                        btn.attr('disabled', true);
                        loader.addClass('d-inline-block');
                    },
                    success: function(response){
                        setTimeout(function(){
                            loader.removeClass('d-inline-block');
                            btn.attr('disabled', false);
                            console.log(response);
                            $('.after-posts').before(response);
                        }, 1000);
                    },
                    error: function(){
                        alert('Ошибка!');
                        loader.removeClass('d-inline-block');
                        btn.attr('disabled', false);
                    }
                });
            });
        });
    </script>
@endsection
