<rss version="2.0"
     xmlns:content="http://purl.org/rss/1.0/modules/content/">
    <channel>
        <title>News Publisher</title>
        <link>{{ url('/rss.xml')}}</link>
        <description>
            {{$setting->meta_description}}
        </description>
        <language>en-us</language>
        
        
        @foreach($posts as $post)
            <item>
            <title>{{htmlspecialchars(htmlentities($post->headline))}}</title>
            <link>{{ news_url($post->id) }}</link>
            <guid>{{ news_url($post->id) }}</guid>
            
            <pubDate>{{ $post->created_at }}</pubDate>
            <description>{{htmlspecialchars(htmlentities($post->excerpt))}}</description>
            
            <content:encoded>
                <![CDATA[
                <!doctype html>
                <html lang="en" prefix="op: http://media.facebook.com/op#">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                    <link rel="canonical" href="{{ news_url($post->id) }}">
                    <meta property="op:markup_version" content="v1.0">
                    <meta property="fb:use_automatic_ad_placement" content="enable=true ad_density=default">
                </head>
                <body>
                <article>
                    <header>
                        <figure>
                            <img src="{{ $post->featured_image }}"/>
                            <figcaption>{{ $post->headline }}</figcaption>
                        </figure>
                        
                        <h1>{{$post->headline}}</h1>
                        @if($post->subtitle)
                            <h2>{{ $post->subtitle }}</h2>
                        @endif
                        <h3 class="op-kicker">{{$post->Category()->first()->name }}</h3>
                        
                        <!-- Ad to be automatically placed throughout the article -->
                        
                        <figure class="op-ad">
                        <iframe width="300" height="250" style="border:0; margin:0;" src="https://www.facebook.com/adnw_request?placement=174603360461633_174603387128297&amp;adtype=banner300x250"></iframe>
                        </figure>
                        <time class="op-published" datetime="{{ $post->created_at->toW3cString() }}">{{ $post->created_at->format('F d, Y') }}</time> 
                      
                    </header>
                    <!— Article body goes here -->
                    {!! $post->post_content !!}
                    
                </article>
                </body>
                </html>
                ]]>
            </content:encoded>
        </item>
        @endforeach
        
        </channel>
</rss>

