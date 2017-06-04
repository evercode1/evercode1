@foreach($posts as $post)

    <div class="blog-post">
        <h2 class="blog-post-title">{{ $post->title }}</h2>
        <p class="blog-post-meta">{{ $post->published_at }} by <a href="#">{{ $post->user->name }}</a></p>
        {!! $post->body !!}

        @include('layouts.blog-partials.signature')

    @endforeach

    </div><!-- end blog-post -->







