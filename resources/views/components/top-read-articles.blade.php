@php
    $topReadArticles = App\Models\Article::with('category')
        ->orderByDesc('views')
        ->limit(4)
        ->get();
@endphp

<span class="thmost">
    <img src="{{ asset('/assets/front/images/icons/thmost.png') }}" alt="">
    الاكثر قراءه
</span>
<div class="themost">
    @foreach ($topReadArticles as $topReadArticle)
        <div class="card section-main-card">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="{{ $topReadArticle->main_image() }}" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="info">
                        <a href="{{ redirectCategoryRoute($topReadArticle->category) }}"><span
                                class="card-section-title">{{ $topReadArticle->category?->title }}</span></a>
                        <a href="{{ redirectArticleRoute($topReadArticle) }}">
                            <h2 class="card-section-text line-clamp">
                                {{ $topReadArticle->title }}
                            </h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
