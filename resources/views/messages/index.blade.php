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

                    @if (count($messages) > 0)

                        <!-- List group -->

                        <ul class="list-group">


                            @foreach($messages as $message)

                            <li class="list-group-item {{ $message->read ? '' :  ' make-bold'}}">

                                <a href="/support-messages-show/{{ $message->id }}">

                                        {{ $message->created }} -
                                        {{ \App\Utilities\Summarize::summary($message->message) }}

                                </a>
                                <a href="/support-messages-show/{{ $message->id }}">

                                @if ($message->reply )

                                    @if($message->read)

                                    <button class="btn-reply btn-reply-warning pull-right"
                                            type="button">

                                           &nbsp;&nbsp;&nbsp; read &nbsp;&nbsp;&nbsp;

                                    </button>

                                    @else

                                            <button class="btn-reply btn-reply-primary pull-right"
                                                    type="button">

                                              new  reply

                                            </button>

                                    @endif

                                @endif

                                </a>

                            </li>

                                @endforeach

                        </ul>

                        @else

                        You have no support messages.

                        @endif


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