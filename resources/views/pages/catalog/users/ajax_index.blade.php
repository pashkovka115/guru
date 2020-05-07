@foreach($leaders as $user)
    @php
        if ($user->profile) {$profile = $user->profile;} else{$profile = null;}
    @endphp
    <div class="col-lg-4 col-md-6">
        <div class="event-list-autor">
            <img src="assets/site/images/slider_img_autor.jpg" alt="" class="img-fluid img-list-autor">
            <div class="block-list-autor">
                <a href="javascript:void(0);" class="location-event">
                    {{ $profile->city }}, {{ $profile->country }}
                </a>
                <a href="{{ route('site.author.show', ['id'=>$user->id]) }}" class="name-autor">{{$user->name}}</a>
                <p class="text-autor">
                    @if($profile)
                        {{$profile->excerpt}}
                    @endif
                </p>
                <div class="rating-event">
                    @if($profile)
                        <div class="rating">
                            {!! get_raiting_template($user->profile->raiting) !!}
                            @if($user->comments->count() > 0)
                                <span
                                    class="review-count">&nbsp;({{ $user->comments->count() }} {{ Lang::choice('Отзыв|Отзыва|Отзывов', $user->comments->count()) }})</span>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="event-footer">
                    <div class="event-tags">
                        @php
                            $tours = $user->tours_with_category;
                           if ($tours){
                               $cats = [];
                               foreach ($tours as $tour) {

                                     if (!in_array($tour->category->id, $cats)){
                                         // TODO id category

                                         echo "<a href=\"".route('site.catalog.category.name', ['id' => $tour->category->id])."\">{$tour->category->title}</a>";
                                     }
                                       $cats[] = $tour->category->id;
                               }
                           }
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<script> var next_url_page = '{{ $leaders->nextPageUrl() }}'</script>
