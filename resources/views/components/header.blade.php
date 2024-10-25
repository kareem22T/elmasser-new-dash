@php
    $months = array(
    "يناير", "فبراير", "مارس", "إبريل", "مايو", "يونيو",
    "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"
    );

    $days = array(
    "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة", "السبت"
    );
    $categories = \App\Models\Category::select('id', 'title', 'slug')->get();
    $featuredArticles = App\Models\Article::where('is_urgent', 1)
        ->latest()
        ->limit(8)
        ->get();
@endphp



<header>
    <nav class="top">
        <div class="container">
            <div class="right">
                <span class="date">
                    {{$days[Carbon\Carbon::parse(now())->dayOfWeek] . ', ' . Carbon\Carbon::parse(now())->day . ' ' . $months[Carbon\Carbon::parse(now())->month - 1] . ', ' . Carbon\Carbon::parse(now())->year}}
                </span>
                <div class="more"><i class="fa-solid fa-ellipsis"></i></div>
                <div class="links">
                    <a href="/about-us"><i class="icon-info"></i> من نحن</a>
                    <a href="/privacy"><ion-icon name="shield-checkmark-outline"></ion-icon> الخصوصية</a>
                    <a href="/contact-us"><ion-icon name="call-outline"></ion-icon> اتصل بنا</a>
                </div>
            </div>
            <div class="left">
                <div class="links">
                    <a href="/about-ads" class="profile">
                        <span>الاعلانات</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-speakerphone" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M18 8a3 3 0 0 1 0 6" />
                            <path d="M10 8v11a1 1 0 0 1 -1 1h-1a1 1 0 0 1 -1 -1v-5" />
                            <path d="M12 8h0l4.524 -3.77a.9 .9 0 0 1 1.476 .692v12.156a.9 .9 0 0 1 -1.476 .692l-4.524 -3.77h-8a1 1 0 0 1 -1 -1v-4a1 1 0 0 1 1 -1h8" />
                          </svg>
                    </a>
                </div>
                <div class="social">
                    <div class="links">
                        <div class="links" style="position: relative !important; display: flex; gap: 8px">
                            @if(isset($settings->facebook_link) && $settings->facebook_link)
                            <a href="{{ $settings->facebook_link }}" target="_blank"><img src="{{ asset('assets2/imgs/facebook.png') }}"></a>
                        @endif

                        @if(isset($settings->youtube_link) && $settings->youtube_link)
                            <a href="{{ $settings->youtube_link }}" target="_blank"><img src="{{ asset('assets2/imgs/youtube.png') }}"></a>
                        @endif

                        @if(isset($settings->instagram_link) && $settings->instagram_link)
                            <a href="{{ $settings->instagram_link }}" target="_blank"><img src="{{ asset('assets2/imgs/instagram.png') }}"></a>
                        @endif

                        @if(isset($settings->twitter_link) && $settings->twitter_link)
                            <a href="{{ $settings->twitter_link }}" target="_blank"><img src="{{ asset('assets2/imgs/x.png') }}"></a>
                        @endif

                        @if(isset($settings->tiktok) && $settings->tiktok)
                            <a href="{{ $settings->tiktok }}" target="_blank"><img src="{{ asset('assets2/imgs/tiktok.png') }}"></a>
                        @endif

                        @if(isset($settings->snapchat) && $settings->snapchat)
                            <a href="{{ $settings->snapchat }}" target="_blank"><img src="{{ asset('assets2/imgs/snapchat.png') }}"></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="head">
        <div class="container">
            <div class="logo_wrapper">
                <a href="/">
                    <img src="{{ asset('/assets2/imgs/home-maser-logo.jpg')}}?v={{time()}}" alt="logo" class="logo">
                </a>
                <div class="text">
                    رئيس مجلس الادارة: نجلاء كمال
                    <br>
                    رئيس التحرير: محمد أبوزيد
                </div>
            </div>
            <a href="" target="_blank">
                <img src="{{ asset('assets2/imgs/head_advertisment.png') }}" alt="advertisment" class="head_advertisment">
            </a>
        </div>
    </div>
    <nav class="bottom">
        <div class="container">
            <div class="hide-content"></div>
            <div class="right">
                <div class="more">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="links">
                    <a href="/" class="active">الرئيسية</a>
                    @foreach ($categories as $category)
                        <a href="{{ redirectCategoryRoute($category) }}">{{ $category->title }}</a>
                    @endforeach
                </div>
                <div class="mobil_links" style="overflow: auto">
                    <div class="social" style="margin: 12px;padding: 8px; background: #fff;border-radius: 8px">
                        <div class="links" style="position: relative !important; display: flex; gap: 8px">
                            @if(isset($settings->facebook_link) && $settings->facebook_link)
                            <a href="{{ $settings->facebook_link }}" target="_blank"><img src="{{ asset('assets2/imgs/facebook.png') }}"></a>
                        @endif

                        @if(isset($settings->youtube_link) && $settings->youtube_link)
                            <a href="{{ $settings->youtube_link }}" target="_blank"><img src="{{ asset('assets2/imgs/youtube.png') }}"></a>
                        @endif

                        @if(isset($settings->instagram_link) && $settings->instagram_link)
                            <a href="{{ $settings->instagram_link }}" target="_blank"><img src="{{ asset('assets2/imgs/instagram.png') }}"></a>
                        @endif

                        @if(isset($settings->twitter_link) && $settings->twitter_link)
                            <a href="{{ $settings->twitter_link }}" target="_blank"><img src="{{ asset('assets2/imgs/x.png') }}"></a>
                        @endif

                        @if(isset($settings->tiktok) && $settings->tiktok)
                            <a href="{{ $settings->tiktok }}" target="_blank"><img src="{{ asset('assets2/imgs/tiktok.png') }}"></a>
                        @endif

                        @if(isset($settings->snapchat) && $settings->snapchat)
                            <a href="{{ $settings->snapchat }}" target="_blank"><img src="{{ asset('assets2/imgs/snapchat.png') }}"></a>
                        @endif

                    </div>
                    </div>
                    <a href="/" class="active">الرئيسية</a>
                    @foreach ($categories as $category)
                        <a href="{{ redirectCategoryRoute($category) }}">{{ $category->title }}</a>
                    @endforeach
                </div>
            </div>
            <div class="left">
                <a href="" class="more"><i class="fa-solid fa-grip"></i></a>
                <a href="" class="search_btn"><i class="fa-solid fa-magnifying-glass"></i></a>
            </div>
        </div>
    </nav>

    <div class="news_slider">
        {{-- <div class="container"> --}}
            <div class="bar" style="width: 100vw;padding: 4px 0">
                @if ($featuredArticles->count() > 0)
                    <div class="ticker-wrap" style="width: 100%;">

                        <div id="ticker" style="font-weight: 500;font-size: 19px;line-height: 36px;text-align: right;color: #000000;white-space: nowrap;">


                            <div id="ticker-box" style="overflow: hidden; min-height: 40px;">
                                <ul style="padding: 0px; margin: 0px; position: relative; list-style-type: none;">

                                    <li style="display: flex; justify-content: center; align-items: center; gap: 12px;font-size: 14px;font-weight: 500;    position: absolute; white-space: nowrap; right: -3543px; color: rgb(0, 0, 0);">
                                        @foreach ($featuredArticles as $index => $article)
                                            <a href="{{ redirectArticleRoute($article) }}" style="text-decoration: none; color:rgb(0, 0, 0); display: inline-flex;justify-content: center; align-items: center;gap: 12px;margin-right: 12px">
                                            {{ $article->title }}
                                                @if ($index + 1 !== $featuredArticles->count())
                                                    <img src="{{ asset("/site/imgs/logo_t.png")}}" alt="" style="width: 18px">
                                                @endif
                                            </a>
                                        @endforeach
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                @endif

            </div>
            <script>
                function getBrowser() {
                    var ua = navigator.userAgent;
                    if (ua.indexOf("Chrome") > -1 && ua.indexOf("Edg") === -1 && ua.indexOf("OPR") === -1) {
                        return "Chrome";
                    } else if (ua.indexOf("Firefox") > -1) {
                        return "Firefox";
                    } else if (ua.indexOf("Safari") > -1 && ua.indexOf("Chrome") === -1) {
                        return "Safari";
                    } else if (ua.indexOf("Edg") > -1) {
                        return "Edge";
                    } else if (ua.indexOf("OPR") > -1) {
                        return "Opera";
                    } else {
                        return "Other";
                    }
                }

                var isMobile = window.innerWidth <= 767;
                var browser = getBrowser();
                var speed;

                if (browser === "Chrome") {
                    speed = isMobile ? 11 : 10;
                } else if (browser === "Firefox") {
                    speed = isMobile ? 12 : 1;
                } else {
                    speed = isMobile ? 13 : 10; // Default speed for other browsers
                }

                startTicker('ticker-box', {speed: speed, delay: 500});
            </script>

          </div>
    {{-- </div> --}}

        <form action="{{route('search.show')}}" method="get" id="search" class="search" style="position: fixed;top: 0;left: 0;width: 100%;height: 100vh;background: #0000003b;z-index: 99999999999999;padding: 1rem;box-sizing: border-box;">
                        <!-- Added v-model binding and @input event handler for search functionality -->
        <div class="hide-content-2" style="position: fixed;width: 100%;height: 100vh;top: 0;left: 0;background: #0003;z-index: 9999"></div>
        <input type="text"id="search_text" name="search_text" style="width: 100%;z-index: 999999;position: relative;text-align: right;direction: rtl;padding: 10px;border-radius: 8px;" placeholder="بحث ..." >
        <button type="submit" style="transform: none;top: 28px;left: 28px;z-index: 99999991;position: absolute;" >
            بحث
            <i class="fa fa-search"></i>
        </button>
        <!-- Added suggestion box for search results -->
    </form>
</header>

<script>
    $('#search').submit(function () {
        if ($.trim($("#search_text").val()) === "") {
            return false;
        }
    });
</script>
