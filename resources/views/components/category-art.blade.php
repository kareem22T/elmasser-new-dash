@php
    $artCategory = App\Models\Category::with([
        'articles' => function ($query) {
            $query->limit(5);
        },
    ])->where('slug', 'art-news')->first();
@endphp


<section class="technology">
    <div class="container">
        <img class="img-fluid poster" src="{{ asset('/assets/front/images/poster1.jpg') }}" alt="">
        <div class="card">
            <div class="BlackHeaderBlock">
                <h2>{{ $artCategory->title }}</h2>
                <span></span>
                <a href=" {{ redirectCategoryRoute($artCategory)}} ">
                    <i class="fa-solid fa-ellipsis"></i>
                </a>
            </div>
            @if ($artCategory->articles->count())
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <div class="card-medium-all">
                            <div class="card-medium bigCard">
                                <a href="{{ redirectArticleRoute($artCategory->articles->first()) }}"><img
                                        src="{{ $artCategory->articles->first()->main_image() }}" alt=""></a>
                                <a href="{{ redirectArticleRoute($artCategory->articles->first()) }}">
                                    <h2 class="card-section-text lg-card-medium-img line-clamp">
                                        {{ $artCategory->articles->first()->title }}
                                    </h2>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row no-gutters">
                            @foreach ($artCategory->articles->skip(1) as $k => $article)
                                <div class="col-md-6">
                                    <div class="card-medium-all">
                                        <div class="card-medium">
                                            <a href="{{redirectArticleRoute($article)}}"><img
                                                    src=" {{ $article->main_image() }}" alt=""></a>
                                            <a href="{{redirectArticleRoute($article)}}">
                                                <h2 class="card-section-text md-card-medium-img line-clamp">
                                                    {{ $article->title }}
                                                </h2>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </div>
</section>
