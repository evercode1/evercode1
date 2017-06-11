@extends('layouts.master-guest-auth')

@section('content')


    <div class="col-sm-8 blog-main">


    <div class="container">


        <div class="col-md-8 mt-25">

            <div class="blog-post">

                <h2 class="blog-post-title">{{ $contact->contactTopic->name }}</h2>

                <p class="blog-post-meta">{{ $contact->created_at }} by <a href="#">{{ $contact->user->name }}</a></p>

                <a href="#">{{ $contact->user->name }}</a> said:

                <p class="mt-10">{{ $contact->message }}</p>

                <div class="mt-20">

                    @include('contact.reply-form', ['user_id' => $contact->user_id, 'contact_id' => $contact->id])


                </div>

                <div class="heading mt-20">


                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Message History</div>
                        <div class="panel-body">
                            <!-- List group -->
                            <ul class="list-group">

                                @foreach($messages as $message)

                                <li class="list-group-item">

                                    {{ $message->created }}

                                    -

                                    {{ $message->message}}

                                </li>


                                @if($message->reply)

                                    <li class="list-group-item">{{ $message->replied }} - Support replied:</li>

                                        <li class="list-group-item">{{ $message->reply }}</li>

                                    @else

                                        <li class="list-group-item">No Reply From Support yet.</li>


                                    @endif



                                @endforeach

                            </ul>
                        </div>



                    </div>




                </div>


            </div><!-- end blog-post -->

        </div> <!-- end column -->

    </div><!--  end blog-main -->


    </div> <!-- end container -->


@endsection
