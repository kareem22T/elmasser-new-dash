@php
    $categories = App\Models\Category::with([
        'articles' => function ($query) {
            $query->limit(4);
        },
    ])->whereIn('slug', ['news', 'sports'])->get();
@endphp

    <!--  Start  Poll-->
<section class="Poll">
    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-lg-4">
                    <div class="card">
                        <div class="BlackHeaderBlock">
                            <h2>{{ $category->title }}</h2>
                            <span style="background: #c22127"></span>
                            <a href="{{ redirectCategoryRoute($category) }}">
                                <i class="fa-solid fa-ellipsis"></i>
                            </a>
                        </div>
                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <div class="all-cards">
                                    @foreach ($category->articles as $k => $article)
                                        <div class="{{ $k == 0 ? 'card-small' : 'left-card' }}">
                                            <a href="{{ redirectArticleRoute($article) }}"><img
                                                    src="{{ $article->main_image() }}" alt="">
                                            </a>
                                            <a href="{{ redirectArticleRoute($article) }}">
                                                <h2
                                                    class="{{ $k == 0 ? 'card-section-text line-clamp line-clamp-height' : 'card-section-text line-clamp' }}">
                                                    {{ $article->title }}
                                                </h2>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-lg-4">
                <x-poll-card/>
            </div>
        </div>
    </div>
</section>
<!--  End  Poll-->
