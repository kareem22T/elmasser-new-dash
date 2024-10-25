@php
    $videosCategory = App\Models\Category::with([
        'articles' => function ($query) {
            $query->limit(4);
        },
    ])->where('slug', 'videos')->first();

@endphp



    <!--  Start  TVEgypt-->
<section class="TVEgypt">
    <div class="container">
        <div class="row-title">
            <span class="TVEgypt-tv-title">
                <img class="title" src="{{ asset('/assets/front/images/icons/tv-title.png') }}" alt="">
                <b> TV مصر الآن</b>
            </span>
            <a href="{{redirectCategoryRoute($videosCategory)}}">
                <span class="moreDetails">عرض المزيد</span>
            </a>
        </div>
        <div class="row no-gutters">
            @foreach ($videosCategory->articles as $article)
                <div class="col-md-3">
                    <div class="card-small">
                        <div class="icons-img-card-small">
                            <img class="tv-img" src="{{ $article->main_image() }}" alt="">
                            <a href="{{redirectArticleRoute($article)}}"><img class="tv-post"
                                                                              src="{{ asset('/assets/front/images/icons/tv-post.png') }}"
                                                                              alt=""></a>
                        </div>
                        <a href="{{redirectArticleRoute($article)}}">
                            <h2 class="card-section-text line-clamp">
                                {{ $article->title }}
                            </h2>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!--  End  TVEgypt-->
