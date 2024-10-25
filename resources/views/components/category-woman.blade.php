@php
    $womanCategory = App\Models\Category::with([
        'articles' => function ($query) {
            $query->limit(4);
        },
    ])->where('slug', 'woman-and-child')->first();

@endphp

    <!--  Start  Economy-->
<section class="Economy">
    <div class="container">
        <div class="card">
            <div class="BlackHeaderBlock">
                <h2>{{ $womanCategory->title }}</h2>
                <span></span>
                <a href="{{redirectCategoryRoute($womanCategory)}}">
                    <i class="fa-solid fa-ellipsis"></i>
                </a>
            </div>
            <div class="row no-gutters">
                @foreach ($womanCategory->articles as $k => $article)
                    <div class="col-md-3">
                        <div class="card-medium-all">
                            <div class="card-small">
                                <a href="{{redirectArticleRoute($article)}}"><img
                                        src="{{ $article->main_image() }}"
                                        alt=""></a>
                                <a href="{{redirectArticleRoute($article)}}">
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
