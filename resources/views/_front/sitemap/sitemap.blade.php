
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($posts as $post)
        <url>
            <loc>{{ news_url($post->id) }}</loc>
            <changefreq>daily</changefreq>
            <lastmod>{{ $post->created_at }}</lastmod>
            <priority>0.85</priority>
        </url>
    @endforeach
</urlset>