@extends('layouts.master-guest-auth')

@section('content')


    <div class="col-sm-8 blog-main">


    <div class="container">


        <div class="col-md-8 mt-25">

            <div class="blog-post">

                <h2 class="blog-post-title">{{ $post->title }}</h2>

                <p class="blog-post-meta">{{ $post->published_at }} by <a href="#">{{ $post->user->name }}</a></p>

                {!! $post->body !!}

                @include('layouts.blog-partials.signature')

            </div><!-- end blog-post -->

        </div> <!-- end column -->

    </div><!--  end blog-main -->



    </div> <!-- end container -->



@endsection

@section('scripts')

    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <script src="/js/format_brackets.js"></script>
    @endsection