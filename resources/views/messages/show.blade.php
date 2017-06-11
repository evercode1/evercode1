@extends('layouts.master-guest-auth')

@section('content')


    <div class="col-sm-8 blog-main">


    <div class="container">


        <div class="col-md-8 mt-25">

            <div class="blog-post">

                <h2 class="blog-post-title">Support</h2>

                <section class="mt-25">

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><a href="/contact/create"><button class="btn btn-primary" type="button">
                            Create New Support Request
                        </button></a></div>
                    <div class="panel-body">

                        @if($reply)

                        <p class="blog-post-meta">Support replied on {{ $reply->created_at->format('m-d-Y') }}:</p>



                        <p>{{ $reply->reply }}</p>

                        <p class="blog-post-meta"> In reply to your {{ $message->created_at->format('m-d-Y') }} message: </p>

                        @endif

                            <p> {{ $message->message }}  </p>

                    </div>


                </div>

                </section>



            </div><!-- end blog-post -->

        </div> <!-- end column -->

    </div><!--  end blog-main -->



    </div> <!-- end container -->



@endsection

@section('scripts')

    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <script src="/js/format_brackets.js"></script>
    @endsection