@php
    $website_settings = [
        'website_url' => env('APP_URL'),
        'website_name' => $settings->website_name,
        'website_description' => $settings->website_bio,
        'main_color' => '#0172b8',
        'second_color' => '#d6e0ea',
        'social_links' => [
            'facebook_link' => '',
            'twitter_link' => '',
            'instagram_link' => '',
            'youtube_link' => '',
            'telegram_link' => '',
            'linkedin_link' => '',
            'whatsapp_link' => '',
            'tiktok_link' => '',
        ],
        'website_icon' => $settings->website_icon() /*"data:image/png;base64,". base64_encode(file_get_contents($settings->website_icon()))*/, //lite
        'website_icon_url' => $settings->website_icon(), //lite
        'website_logo' => $settings->website_logo(), //lite
        'website_cover' => $settings->website_cover(), //lite
        'phone' => $settings->phone(),
        'search_url' => env('APP_URL') . '/q',
        'faq_url' => env('APP_URL') . '/faq',
        'feed_url' => env('APP_URL') . '/feed',
        'feed_title' => 'آخر الأخبار',
        'cache_pages' => 1,
        'canonical' => str_replace('/index.php', '', request()->url()),
        'twitter_author' => 'Nafezly',
    ];
    $website_settings = collect($website_settings);
    if (request()->url() == env('APP_URL')) {
        $page_title = isset($page_title) && $page_title != null ? $website_settings['website_name'] . ' | ' . $page_title : $website_settings['website_name'];
    } else {
        $page_title = isset($page_title) && $page_title != null ? $page_title . ' | ' . $website_settings['website_name'] : $website_settings['website_name'];
    }
    $page_description = isset($seo_meta_description) && $seo_meta_description != null ? $seo_meta_description : $website_settings['website_description'];
    $page_author = isset($page_author) && $page_author != null ? $page_author : '';
    $page_image = isset($page_image) && $page_image != null ? $page_image : $website_settings['website_cover'];
    $page_keywords = isset($seo_key_words) && $seo_key_words != null ? $seo_key_words : '';
    $website_settings['canonical'] = isset($canonical) && $canonical != null ? $canonical : $website_settings['canonical'];
@endphp
<title>{{ $page_title }}</title>
@if ($page_author)
<meta name="author" content="{{ $page_author }}" />
@endif
<meta name="description" content="{{ $page_description }}" />
@if ($page_keywords)
<meta name="keywords" content="{{ $page_keywords }}" />
@endif
<link rel="canonical" href="{{ $website_settings['canonical'] }} /">
<meta property="og:locale" content="ar_AR" />
<meta property="og:type" content="website" />
<meta property="og:title" content="{{ $page_title }}" />
<meta property="og:description" content="{{ $page_description }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:site_name" content="{{ $website_settings['website_name'] }}" />
<meta property="og:image" content="{{ $page_image }}" />
<meta property="og:image:width" content="700" />
<meta property="og:image:height" content="400" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="fb:app_id" content="577277657270064" />
<meta name="twitter:title" content="{{ $page_title }}" />
<meta name="twitter:description" content="{{ $page_description }}" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:image" content="{{ $page_image }}" />
<meta name="twitter:site" content="@misrelaan1" />
<meta name="twitter:creator" content="@misrelaan1" />
<link rel="icon" type="image/png" href="{{ $website_settings['website_icon'] != null ? $website_settings['website_icon'] : $website_settings['website_icon_url'] }}" />
<link rel="manifest" href="{{ $website_settings['website_url'] }}/manifest.json">
<meta name="theme-color" content="{{ $website_settings['main_color'] }}">
<meta name="mobile-web-app-capable" content="no">
<meta name="application-name" content="{{ $website_settings['website_name'] }}" />
<meta name="apple-mobile-web-app-capable" content="no">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="{{ $website_settings['website_name'] }}">
<link rel="apple-touch-icon" href="{{ $website_settings['website_icon_url'] }}?v=2">
<link rel='alternate' href="{{ request()->url() }}" hreflang='x-default' />
{{--@if ($website_settings['feed_title'] != null && $website_settings['feed_url'] != null)
    <link rel="alternate" type="application/rss+xml"
        title="{{ $website_settings['feed_title'] }}" href="{{ $website_settings['feed_url'] }}">
@endif--}}
@if ($website_settings['cache_pages'] == 0)
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate, no-transform">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="-1">
@endif
{{--<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": "{{$website_settings['website_name']}}",
    "url": "{{$website_settings['website_url']}}",
    "logo": "{{$website_settings['website_icon_url']}}",
    @php
    $social_links=[];
    foreach($website_settings['social_links'] as $key => $link){
        if($link!=null)array_push($social_links, $link);
    }
    @endphp
    @if(count($social_links))
    "sameAs": [

        @foreach($social_links as $link)
            "{{$link}}"
            @if(!$loop->last),@endif
        @endforeach
    ],
    @endif
    "contactPoint": [
        @if($website_settings['phone']!=null)
        {
            "@type": "ContactPoint",
            "telephone": "{{$website_settings['phone']}}",
            "contactType": "customer support"
        },
        {
            "@type": "ContactPoint",
            "telephone": "{{$website_settings['phone']}}",
            "contactType": "technical support"
        }, {
            "@type": "ContactPoint",
            "telephone": "{{$website_settings['phone']}}",
            "contactType": "billing support"
        }
        @endif
    ]
}
{
    "@context": "http://schema.org",
    "@type": "WebSite",
    "url": "{{$website_settings['website_url']}}",
    "potentialAction": {
        "@type": "SearchAction",
        "target": "{{$website_settings['search_url']}}?key={search_term_string}",
        "query-input": "required name=search_term_string"
    }
}
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "{{$page_title}}",
    "description": "{{$page_description}}",
    "publisher": {
        "@type": "Organization",
        "name": "{{$website_settings['website_name']}}"
    }
}
</script>--}}
<script type="text/javascript">
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/serviceworker.js', {
            scope: '.'
        }).then(function(registration) {
            console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
        }, function(err) {
            console.log('Laravel PWA: ServiceWorker registration failed: ', err);
        });
    }
</script>
