@foreach($posts as $post)
<div class="col-lg-4 col-md-12">
    <div class="elem__news elems_journal">
        <img src="{{ $post->img }}" alt="" class="img-fluid img-news">
        <a href="{{ route('site.journal.blog.show', ['journal' => $post->id]) }}" class="title-news">{{ $post->title }}</a>
        <p class="description-news">{{ $post->excerpt }}</p>
    </div>
</div>
@endforeach
@php
if ($posts->lastPage() == $posts->currentPage()){
    $next_url_page = null;
}else{
    $next_url_page = $posts->nextPageUrl();
}
@endphp
<script> next_url_page = '{{ $next_url_page }}'; </script>
