@extends('layouts.app', ['seo_key_words' => $settings->address])
@php
    $prices = App\Models\Price::get();
    $trend = App\Models\Article::latest()->where('is_trend', true)->take(15)->get();
    $months = [
        'يناير',
        'فبراير',
        'مارس',
        'إبريل',
        'مايو',
        'يونيو',
        'يوليو',
        'أغسطس',
        'سبتمبر',
        'أكتوبر',
        'نوفمبر',
        'ديسمبر',
    ];

    $days = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];
    $latest_news = App\Models\Article::latest()->take(15)->get();
    $categories_per_home = App\Models\Category::where('is_at_home', true)->with(['articles' => function ($query) {
                $query->latest()->take(4);
            }])->take(4)->get();
    $categories_per_home_2 = App\Models\Category::where('is_at_home', true)->with(['articles' => function ($query) {
                $query->latest()->take(4);
            }])->skip(4)->take(4)->get();
    $more_visited = App\Models\Article::whereDate('created_at', '>=', Carbon\Carbon::now()->subDays(1)->toDateString())
            ->orderBy('views', 'desc')
                        ->take(6)
                        ->get(); // Filter articles from the last day

@endphp
@section('content')
    <section class="main">
        <img src="{{ asset('assets2/imgs/home-maser-outer.jpg') }}" alt="" class="ad">
        <div style="max-width: 100vw;">
            <div class="container">
                <div class="top_ad">
                    <img src="{{ asset('assets2/imgs/top_ad.png') }}" alt="">
                </div>

                <x-slider />

                <div class="digital_coins">
                    <div>
                        <div class="prices">
                            <h2><ion-icon name="pricetags-outline"></ion-icon> اسعار اليوم</h2>
                            <div>
                                @if ($prices->count())
                                    @foreach ($prices as $price)
                                        <h4><img src="{{ asset('/assets2/imgs/gold_icon.png') }}" alt="">
                                            {{ $price->title }}:
                                            <span>{{ $price->description }}</span>
                                        </h4>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="top_ad">
                            <img src="{{ asset('assets2/imgs/top_ad.png') }}" alt="">
                        </div>
                    </div>
                    <div class="ad-left-2">
                        <img src="{{ asset('assets2/imgs/home-maser-ad-2.jpg') }}?v={{time()}}" alt="">
                    </div>
                </div>

                @if ($trend->count() > 0)
                    <div class="trend">
                        <h1 class="head-light head"><i class="fa-solid fa-bolt"></i>تريند المصير اليوم <span
                                class="line"></span></h1>
                        <div class="swiper trendSlider">
                            <div class="swiper-wrapper">
                                @foreach ($trend as $article)
                                    <div class="swiper-slide">
                                        <a href="{{ redirectArticleRoute($article) }}" class="img">
                                            <img src="{{ $article->main_image() }}" alt="">
                                        </a>
                                        <div class="text">
                                            <a href="{{ redirectCategoryRoute($article->category) }}">
                                                <h4 class="head-eg">{{ $article->category?->title }}</h4>
                                            </a>
                                            <a href="{{ redirectArticleRoute($article) }}">
                                                <p>{{ $article->title }}</p>
                                            </a>
                                            <span class="date"><i class="fa-regular fa-calendar-days"></i>
                                                {{ $days[Carbon\Carbon::parse($article->created_at)->dayOfWeek] . ', ' . Carbon\Carbon::parse($article->created_at)->day . ' ' . $months[Carbon\Carbon::parse($article->created_at)->month - 1] . ', ' . Carbon\Carbon::parse($article->created_at)->year . ' ' . str_replace(['AM', 'PM'], ['ص', 'م'], Carbon\Carbon::parse($article->created_at)->format('h:i A')) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                @endif

                @if ($latest_news->count() > 0)
                    <div class="borsa">
                        <div class="container">
                            <h1 class="head-dark head"><i class="fa-solid fa-chart-simple"></i>اهم اخبار اليوم <span
                                    class="line"></span></h1>
                            <div class="swiper borsaSlider">
                                <div class="swiper-wrapper">
                                    @foreach ($latest_news as $article)
                                        <a href="{{ redirectArticleRoute($article) }}" class="swiper-slide">
                                            <div class="img">
                                                <img src="{{ $article->main_image() }}" alt="">
                                            </div>
                                            <div class="text">
                                                <p>{{ $article->title }}</p>
                                                <span
                                                    class="date">{{ $days[Carbon\Carbon::parse($article->created_at)->dayOfWeek] . ', ' . Carbon\Carbon::parse($article->created_at)->day . ' ' . $months[Carbon\Carbon::parse($article->created_at)->month - 1] . ', ' . Carbon\Carbon::parse($article->created_at)->year . ' ' . str_replace(['AM', 'PM'], ['ص', 'م'], Carbon\Carbon::parse($article->created_at)->format('h:i A')) }}</span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            <div class="economics">
                <div class="container">
                    @if ($categories_per_home->count() > 0)
                        @foreach ($categories_per_home as $index => $category)
                            <div>
                                <h4>{{ $category?->title }} <ion-icon name="ellipsis-horizontal-outline"></ion-icon>
                                </h4>
                                @foreach ($category?->articles as $index => $article)
                                    <a href="{{ redirectArticleRoute($article) }}"
                                        class="{{ $index === 0 ? 'main-article eg' : '' }}"
                                        style="{{ 'border-color:' . $category?->color }}">
                                        <div class="img">
                                            <img src="{{ $article->main_image() }}" alt="">
                                        </div>
                                        <p style="height: 80px;overflow: hidden;text-overflow: ellipsis;">
                                            {{ $article->title }}
                                        </p>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="container">
                <div class="top_ad">
                    <img src="{{ asset('assets2/imgs/top_ad.png') }}" alt="">
                </div>
            </div>
            @if ($more_visited && $more_visited->count() > 3)
                <div class="most-read">
                    <div class="container">
                        <h1 class="head-dark head"><i class="fa-solid fa-arrow-trend-up"></i> الاخبار الاكثر قراءة <span
                                class="line"></span></h1>
                        <div class="news">
                            @foreach ($more_visited as $article)
                                <div>
                                    <a href="{{ redirectArticleRoute($article) }}" class="img">
                                        <img src="{{ $article->main_image() }}" alt="">
                                    </a>
                                    <div class="text">
                                        <a href="{{ redirectCategoryRoute($article->category) }}">
                                            {{ $article->category?->title }} <i
                                                class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                        <a href="{{ redirectArticleRoute($article) }}">{{ $article->title }}</a>
                                        <span
                                            class="date">{{ $days[Carbon\Carbon::parse($article->created_at)->dayOfWeek] . ', ' . Carbon\Carbon::parse($article->created_at)->day . ' ' . $months[Carbon\Carbon::parse($article->created_at)->month - 1] . ', ' . Carbon\Carbon::parse($article->created_at)->year . ' ' . str_replace(['AM', 'PM'], ['ص', 'م'], Carbon\Carbon::parse($article->created_at)->format('h:i A')) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @if ($categories_per_home_2->count() > 0)
            @foreach ($categories_per_home_2 as $index => $category)
                <div class="borsa-2">
                    <div class="container">
                        <h1 class="head-dark head"><i
                                class="fa-solid fa-chart-simple"></i>{{ $category?->title }} <span
                                class="line"></span>
                        </h1>
                        <div class="swiper borsaSlider">
                            <div class="swiper-wrapper">
                                @foreach ($category?->articles as $index => $article)
                                <a href="{{ redirectArticleRoute($article) }}" class="swiper-slide"
                                style="text-decoration: none">

                                    <div class="img">
                                        <img src="{{ $article->main_image() }}" alt="">
                                    </div>
                                    <div class="text">
                                        <p>{{ $article->title }}</p>
                                        <span
                                            class="date">{{ $days[Carbon\Carbon::parse($article->created_at)->dayOfWeek] . ', ' . Carbon\Carbon::parse($article->created_at)->day . ' ' . $months[Carbon\Carbon::parse($article->created_at)->month - 1] . ', ' . Carbon\Carbon::parse($article->created_at)->year . ' ' . str_replace(['AM', 'PM'], ['ص', 'م'], Carbon\Carbon::parse($article->created_at)->format('h:i A')) }}</span>
                                    </div>
                                </a>
                            @endforeach

                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        </div>
        <img src="{{ asset('assets2/imgs/home-maser-outer.jpg') }}" alt="" class="ad">
    </section>
@endsection
