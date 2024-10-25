@php
    $economyCategory = App\Models\Category::with([
        'articles' => function ($query) {
            $query->limit(4);
        },
    ])->where('slug', 'economy')->first();

@endphp

<!--  Start  Economy-->
<section class="Economy">
    <div class="container">
        <img class="img-fluid poster" src="{{ asset('/assets/front/images/poster1.jpg') }}" alt="">
        <div class="card">
            <div class="BlackHeaderBlock">
                <h2>{{ $economyCategory->title }}</h2>
                <span></span>
                <a href="{{redirectCategoryRoute($economyCategory)}}">
                    <i class="fa-solid fa-ellipsis"></i>
                </a>
            </div>
            <div class="row no-gutters">
                @foreach ($economyCategory->articles as $k => $article)
                    <div class="col-md-3">
                        <div class="card-medium-all">
                            <div class="card-small">
                                <a href="{{ redirectArticleRoute($article) }}"><img src="{{ $article->main_image() }}"
                                        alt=""></a>
                                <a href="{{ redirectArticleRoute($article) }}">
                                    <h2 class="card-section-text line-clamp">{{ $article->title }} </h2>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--  End  Economy-->
