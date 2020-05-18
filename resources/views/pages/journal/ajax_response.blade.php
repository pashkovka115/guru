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
