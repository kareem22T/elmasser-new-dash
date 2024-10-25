@php
    $postcontent = html_entity_decode(strip_tags($article->description));
    $postcontent = preg_replace("/\r|\n/", '', $postcontent);
    $postcontent = str_replace(['"', "'"], '', $postcontent);
    $postcontent = Str::words($postcontent, 50, '');
@endphp


@extends('layouts.app', ['page_title' => $article->title, 'seo_meta_description' => $postcontent, 'page_image' => $article->main_image(), 'seo_key_words' => implode(',', $article->tags->pluck('tag_name')->toArray()), 'page_author' => $article->user->name])
@section('content')
    <style>
        article p {
            display: flex !important;
            flex-wrap: wrap !important;
            line-height: 1.5 !important;
        }

        article span {
            display: flex !important;
            flex-wrap: wrap !important;
            line-height: 1.5 !important;
        }

        article img {
            max-width: 100%;
        }

        iframe {
            width: 100% !important;
        }

        main swiper-container {
            direction: rtl;
            width: 630px !important;
            max-width: 100% !important;
            padding-bottom: 0;
            padding: 0 !important
        }

        main swiper-slide {
            margin: 0 8px !important;
            margin-bottom: 2rem !important
        }

        main .swiper-pagination-bullet {
            background-color: #b10a0b !important;
            bottom: 0;
        }

        .swiper-horizontal>.swiper-pagination-bullets,
        .swiper-pagination-bullets.swiper-pagination-horizontal,
        .swiper-pagination-custom,
        .swiper-pagination-fraction {
            bottom: 0 !important;
        }

        main swiper-slide:first-child {
            margin-left: 0 !important
        }

        main swiper-slide:last-child {
            margin-right: 0 !important
        }

        main swiper-slide img {
            object-fit: fill !important;
            height: max-content !important;
            width: 100% !important;
            border-radius: 10px
        }

        @media (max-width: 1199.98px) {
            main swiper-container {
                direction: rtl;
                width: 580px !important;
                padding-bottom: 0;
            }
        }

        @media (max-width: 992.98px) {
            main swiper-container {
                direction: rtl;
                width: 415px !important;
                padding-bottom: 0;
            }
        }

        @media (max-width: 992.98px) {
            main swiper-container {
                direction: rtl;
                width: 415px !important;
                max-width: 100% !important;
                padding-bottom: 0;
            }
        }

        .embeded_img {
            width: 100% !important;
            max-width: 380px !important;
        }

        .embeded_img p {
            justify-content: center
        }

        .embeded_img img {
            width: 100%;
            border-radius: 10px
        }

        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #e06045
        }
    </style>
    <section class="main">
        @php
    $more_visited = App\Models\Article::whereDate('created_at', '>=', Carbon\Carbon::now()->subDays(1)->toDateString())
            ->orderBy('views', 'desc')
                        ->take(5)
                        ->get(); // Filter articles from the last day
            $latest = App\Models\Article::latest()->take(4)->get();
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

        @endphp

        <img src="{{ asset('assets2/imgs/home-maser-outer.jpg') }}" alt="" class="ad">
        <div class="container">
            <section class="article">
                <div class="top_ad">
                    <img src="{{ asset('assets2/imgs/top_ad.png') }}" alt="">
                </div>
                <br>

                <div class="article-head">
                    <div class="category">
                        <a href="" style="text-decoration: none;font-weight: 700;color: #000;font-size: 14px;">
                            الرئيسية
                        </a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left"
                            width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M15 6l-6 6l6 6" />
                        </svg>
                        <a href="{{ redirectCategoryRoute($article->category) }}"
                            style="text-decoration: none;font-weight: 700;color: #dd5f3c;font-size: 14px;">
                            {{ $article->category?->title }}
                        </a>
                    </div>
                    <h1 style="color: #e06045">{{ $article->title }}</h1>
                    <h2>{{ $article->sub_title }}</h2>
                    <div class="details">
                        <p>
                            <a href="{{ route('author.show', $article->user) }}"
                                style="text-decoration: none;color: #212529;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-news"
                                    width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11" />
                                    <path d="M8 8l4 0" />
                                    <path d="M8 12l4 0" />
                                    <path d="M8 16l4 0" />
                                </svg>
                                {{ $article->user->name }}
                            </a>
                        </p>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-month"
                                width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                <path d="M16 3v4" />
                                <path d="M8 3v4" />
                                <path d="M4 11h16" />
                                <path d="M7 14h.013" />
                                <path d="M10.01 14h.005" />
                                <path d="M13.01 14h.005" />
                                <path d="M16.015 14h.005" />
                                <path d="M13.015 17h.005" />
                                <path d="M7.01 17h.005" />
                                <path d="M10.01 17h.005" />
                            </svg>
                            {{ $days[Carbon\Carbon::parse($article->created_at)->dayOfWeek] . ', ' . Carbon\Carbon::parse($article->created_at)->day . ' ' . $months[Carbon\Carbon::parse($article->created_at)->month - 1] . ', ' . Carbon\Carbon::parse($article->created_at)->year }}
                        </p>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-12"
                                width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 7v5" />
                            </svg>
                            {{ str_replace(['AM', 'PM'], ['ص', 'م'], Carbon\Carbon::parse($article->created_at)->format('h:i A')) }}
                        </p>
                        <div class="social-share">
                            مشاركة عبر:
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}"
                                target="_blank" style="text-decoration: navajowhite;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-facebook"
                                    width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                                </svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}&text={{ urlencode($article->title) }}"
                                target="_blank" style="text-decoration: navajowhite;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-x"
                                    width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 4l11.733 16h4.267l-11.733 -16z" />
                                    <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
                                </svg>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(Request::fullUrl()) }}"
                                target="_blank" style="text-decoration: navajowhite;">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-brand-linkedin" width="20" height="20"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                    <path d="M8 11l0 5" />
                                    <path d="M8 8l0 .01" />
                                    <path d="M12 16l0 -5" />
                                    <path d="M16 16v-3a2 2 0 0 0 -4 0" />
                                </svg>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' ' . Request::fullUrl()) }}"
                                target="_blank" style="text-decoration: navajowhite;">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-brand-whatsapp" width="20" height="20"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                                    <path
                                        d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="category_wrapper">
                    <div class="articles_wrapper">
                        <article>
                            <div class="thumbnail">
                                <img src="{{ $article->main_image() }}" alt=""
                                    style="max-height: 500px; width: 100%;object-fit:cover">
                            </div>
                            <p>
                                {!! $article->description !!}
                            </p>
                            @if ($article->tags && $article->tags->count() > 0)
                                <div class="tags">
                                    @foreach ($article->tags as $tag)
                                        <a
                                            href="{{ redirectTagRoute($tag) }}">{{ $tag->tag_name }}</a>
                                    @endforeach
                                </div>
                                <br>
                            @endif
                        </article>
                    </div>
                    <div class="side" style="margin-top: 16px">
                        @if ($more_visited && $more_visited->count() > 3)
                            <div class="head"
                                style="background: #0168b3; color: #fff; font-size: 26px;font-weight: 700;padding: 8px">
                                الاكثر قراءة
                            </div>
                            <div class="side_articles">
                                @foreach ($more_visited as $visit)
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
                            <div class="ad-left-2" style="margin: 16px 0">
                                    <img src="{{ asset('assets2/imgs/home-maser-ad-2.jpg') }}" alt="">
                                            </div>
                        @if ($latest && $latest->count() > 3)
                            <div class="head"
                                style="background: #0168b3; color: #fff; font-size: 26px;font-weight: 700;padding: 8px">
                                اخر الاخبار
                            </div>
                            <div class="side_articles">
                                @foreach ($latest as $article)
                                    <a href="/article/{{ $article->id }}" class="article">
                                        <img src="{{ $article->thumbnail_path }}" alt="">
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
                <div class="top_ad">
                    <img src="{{ asset('assets2/imgs/top_ad.png') }}" alt="">
                </div>
                <br>
                <br>
                <br>
            </section>
        </div>
        <img src="{{ asset('assets2/imgs/home-maser-outer.jpg') }}" alt="" class="ad">
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('/libs/swiperadmin.js') }}"></script>
    <script>
        var date = new Date({{ $article->created_at }});
        var months = ["يناير", "فبراير", "مارس", "إبريل", "مايو", "يونيو",
            "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"
        ];
        var days = ["اﻷحد", "اﻷثنين", "الثلاثاء", "اﻷربعاء", "الخميس", "الجمعة", "السبت"];
        var delDateString = days[date.getDay()] + ', ' + date.getDate() + ' ' + months[date.getMonth()] + ', ' + date
            .getFullYear();
        $("#formated_date").html('<i class="fa-regular fa-calendar"></i>' + delDateString)
    </script>
    <script>
        $(function() {
            setTimeout(() => {
                $('.mySwiper').attr('pagination', 'true');
            }, 500);
        })
    </script>
    <script>
        const swiperEl = document.querySelector('swiper-container')
        Object.assign(swiperEl, {
            slidesPerView: 1,
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                575: {
                    slidesPerView: 2,
                },
            },
        });
        swiperEl.initialize();
    </script>
@endsection
