<?=
/* Using an echo tag here so the `<? ... ?>` won't get parsed as short tags */
'<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL
?>


<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{{$settings->website_name}}</title>
        <link>{{env('APP_URL')}}</link>
        <description>{{$settings->website_bio}}</description>
        <language>ar</language>
        <pubDate>{{ now() }}</pubDate>

        @foreach($articles as $article)
            @php
                $postcontent = html_entity_decode(strip_tags($article->description));
                $postcontent = preg_replace( "/\r|\n/", "", $postcontent);
                $postcontent = str_replace(['"',"'"], "", $postcontent);
                $postcontent = \Str::words($postcontent, 50,'');
            @endphp
            <item>
                <title>{{ $article->title }}></title>
                <link>{{ redirectArticleRoute($article) }}</link>
                <description>{{$postcontent}}</description>
                <author>{!! $article->user->name  !!}</author>
                <guid>{{ $article->id }}</guid>
                <pubDate>{{ $article->created_at->toRssString() }}</pubDate>
                @foreach($article->tags as $tag)
                    <category>{{ $tag->tag_name }}</category>
                @endforeach
            </item>
        @endforeach
    </channel>
</rss>
