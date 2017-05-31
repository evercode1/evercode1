@extends('layouts.master')

@section('content')

    <div class="container">




        <div class="col-md-8 col-md-offset-2">

            <div class="blog-header">
                <h1 class="blog-title">The Keywordings Blog</h1>
                <p class="lead blog-description">The official example Bill Keck blog for code and entreprenuership.</p>
            </div>

            <article class="white-background rounded-corners-10 pad-20">

            <h2>
                <a href="#">{{ $post->title }}</a>
            </h2>
            <p class="lead">
                by <a href="/">Bill Keck</a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> {{ $post->created_at->diffForHumans() }}</p>
            <hr>



            <section>


                <div class="pad-20">



                    {!! $post->body !!}



                </div>


            </section>

            </article>  <!-- end article -->

        </div> <!-- end column -->



        </div> <!-- end container -->



@endsection

@section('scripts')

    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>

    @endsection