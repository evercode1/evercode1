@extends('layouts.master-guest-auth')


@section('content')



    <div class="col-sm-8 blog-main">


        <div class="container">

            <div class="col-md-8 mt-25">

                <p class="blog-post-meta">Showing {{ $count }} results for {{ $keyword }}:</p>

                @forelse($posts as $post)

                <div class="blog-post">

                    <h1 class="blog-post-title"><a href="/post/{{ $post->Id }}">{{ $post->Title }}</a></h1>

                    <p class="blog-post-meta">{{ $post->Published }} by <a href="/about">{{ $post->Author }}</a></p>

                    <a href="/post/{{ $post->Id }}">{!! \App\Utilities\Summarize::longSummary($post->Body) !!}</a>

                    <hr />


                </div><!-- end blog-post -->

                    @empty

                    <div class="blog-post">

                        <hr />

                        <p>Sorry, there are no results.  Please try another search query.</p>


                    </div><!-- end blog-post -->


                    @endforelse

                @include('layouts.blog-partials.pagination')

            </div> <!-- end column -->

        </div><!--  end blog-main -->



    </div> <!-- end container -->



@endsection

@section('scripts')

    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <script src="/js/format_brackets.js"></script>

@endsection