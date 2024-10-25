@php
    $featuredArticles = App\Models\Article::with('category')
        ->where('is_featured', 1)
        ->latest()
        ->limit(8)
        ->get();
@endphp

<div class="main_articles">
    @if ($featuredArticles->count() > 0)
        <div class="swiper mainSlider">
            <div class="swiper-wrapper">
                @foreach ($featuredArticles->take(5) as $featureArticle)
                        <div class="swiper-slide">
                            <a href="{{ redirectArticleRoute($featureArticle) }}">
                                <img src="{{ $featureArticle->main_image() }}" alt="">
                            </a>
                            <div class="text" style="width: 100%">
                                <div class="head">
                                    <a href="{{ redirectCategoryRoute($featureArticle->category) }}"
                                        style="color: #fff; text-decoration: none">
                                        <i class="fa-solid fa-list"></i>
                                        {{ $featureArticle->category?->title }}
                                    </a>
                                </div>
                                <a href="{{ redirectArticleRoute($featureArticle) }}"
                                    style="width: 100%;display: block;text-decoration: none;">
                                    <p>
                                        <span>{{ $featureArticle->title }}</span>
                                    </p>
                                </a>
                            </div>
                        </div>
                @endforeach

            </div>
            <div class="swiper-pagination"></div>
        </div>
    @endif
    <div class="side-ad">
        <img src="{{ asset('assets2/imgs/home-maser-ad.jpg') }}" alt="">
    </div>
</div>
