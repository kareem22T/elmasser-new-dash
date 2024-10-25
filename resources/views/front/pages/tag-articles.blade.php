@extends('layouts.app', ['page_title' => $tag->tag_name, 'seo_meta_description' => ' موضوعات واخبار حول '. $tag->tag_name])
@section('content')
@if($articles)

<section class="main">
    @php
        $months = array(
            "يناير", "فبراير", "مارس", "إبريل", "مايو", "يونيو",
            "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"
            );

        $days = array(
        "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة", "السبت"
        );
        $more_visited = App\Models\Article::whereDate('created_at', '>=', Carbon\Carbon::now()->subDays(1)->toDateString())
            ->orderBy('views', 'desc')
                        ->take(5)
                        ->get(); // Filter articles from the last day
        $latest = App\Models\Article::latest()
        ->take(4)
        ->get();

    @endphp

<img src="{{ asset('assets2/imgs/home-maser-outer.jpg') }}" alt="" class="ad">
    <div class="container">
        <div class="top_ad">
            <img src="{{ asset('assets2/imgs/top_ad.png') }}" alt="">
        </div>

        <div class="container" dir="rtl">
            <h1 class="cateory_head">
                اخبار حول {{ $tag->tag_name }}
            </h1>
        </div>

        <div class="category_wrapper">
            <div class="articles_wrapper">
                @foreach ($articles as $article)
                <a href="/article/{{$article->id}}" class="article">
                    <img src="{{$article->main_image()}}" alt="">
                    <span>
                        {{ $article->title }}
                    </span>
                    <span class="date">{{ $days[Carbon\Carbon::parse($article->created_at)->dayOfWeek] . ', ' . Carbon\Carbon::parse($article->created_at)->day . ' ' . $months[Carbon\Carbon::parse($article->created_at)->month - 1] . ', ' . Carbon\Carbon::parse($article->created_at)->year}}</span>
                </a>
                @endforeach
            </div>
            <div class="side" style="margin-top: 16px">
                @if($more_visited && $more_visited->count() > 3)
                    <div class="head" style="background: #0168b3; color: #fff; font-size: 26px;font-weight: 700;padding: 8px">
                         الاكثر قراءة
                    </div>
                    <div class="side_articles">
                        @foreach ($more_visited as $visit)
                        @if($visit->article)
                            <a href="{{ redirectArticleRoute($article) }}" class="article">
                                <img src="{{ $visit->article->thumbnail_path }}" alt="">
                                <div class="text">
                                    <i class="fa-solid fa-angle-left"></i>
                                    {{ $visit->article->title }}
                                </div>
                            </a>

                        @endif
                        @endforeach
                    </div>
                @endif
                <div class="ad-left-2" style="margin: 16px 0">
                    <img src="{{ asset('assets2/imgs/home-maser-ad-2.jpg') }}" alt="">
                            </div>
                @if($latest && $latest->count() > 3)
                    <div class="head" style="background: #0168b3; color: #fff; font-size: 26px;font-weight: 700;padding: 8px">
                        اخر الاخبار
                    </div>
                    <div class="side_articles">
                        @foreach ($latest as $article)
                            <a href="{{ redirectArticleRoute($article) }}" class="article">
                                <img src="{{ $article->main_image() }}" alt="">
                                <div class="text">
                                    <i class="fa-solid fa-angle-left"></i>
                                    {{ $article->title }}
                                </div>
                            </a>

                        @endforeach
                    </div>
                @endif
            </div>
    </div>

        <div class="pagination_wrapper" style="margin-bottom: 16px !important;flex-wrap: wrap;">
            {!! $articles->links('pagination::bootstrap-4') !!}
        </div>
        <div class="top_ad">
            <img src="{{ asset('assets2/imgs/top_ad.png') }}" alt="">
        </div>
    <br>
    <br>
    <br>
    </div>
    <img src="{{ asset('assets2/imgs/home-maser-outer.jpg') }}" alt="" class="ad">
</section>
@endif
@endsection
