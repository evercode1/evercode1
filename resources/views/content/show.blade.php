@extends('layouts.master-guest-auth')

@section('content')


    <div class="col-sm-8 blog-main">


    <div class="container">


        <div class="col-md-8 mt-25">

            <div class="blog-post">

                <h2 class="blog-post-title">{{ $content->name }}</h2>

                <p class="blog-post-meta">Created on {{ $content->created_at->format('Y-m-d') }}</p>

                {!! $content->body !!}

            </div><!-- end blog-post -->

        </div> <!-- end column -->

    </div><!--  end blog-main -->

    </div> <!-- end container -->



@endsection

