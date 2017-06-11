@extends('layouts.master-guest-auth')

@section('content')


    <div class="col-sm-8 blog-main">


    <div class="container">


        <div class="col-md-8 mt-25">

            <div class="blog-post">

                <h2 class="blog-post-title">{{ $contact->contactTopic->name }}</h2>

                <p class="blog-post-meta">{{ $contact->created_at }} by <a href="#">{{ $contact->user->name }}</a></p>

                <span class="list-group-item-head">{{ $contact->user->name }} said:</span>

                <p class="list-group-item-text">{{ $contact->message }}</p>

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

                                    @if( ! $message->reply)

                                        <span class="list-group-item-head">{{ $message->created }} {{ $contact->user->name }} requested:</span>

                                <li class="list-group-item-text">


                                   "{{ $message->message}}"

                                </li>

                                        @else

                                         <span class="list-group-item-head">{{ $message->created }} {{ $contact->user->name }} requested:</span>

                                    <li class="list-group-item-text">"{{ $message->message}}"</li>

                                    @endif




                                @if($message->reply)

                                    <li class="list-group-item-reply">Support replied on {{ $message->replied }}:</li>

                                        <li class="list-group-item-reply">"{{ $message->reply }}"</li>

                                    @else

                                        <li class="list-group-item-reply">
                                            <a href="/contact/{{ $message->id }}">No Reply From Support yet.</a>
                                        </li>


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
