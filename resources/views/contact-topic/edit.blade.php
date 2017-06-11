@extends('layouts.master-admin')


@section('content')

    <div class="container ">




        <section class="pull-right mt-25">

            <ol class="breadcrumb">

                <li><a href="/"></i> Home</a></li>
                <li><a href="/contact-topic">Contact Topics</a></li>
                <li class="active">Edit {{ $contactTopic->name }}</li>

            </ol>

        </section>



            <div class="col-md-8 col-md-offset-2">

        <h1 class="section-title">Edit Contact Topic</h1>



        <section class="white-background rounded-corners-10 pad-20">


            @include('contact-topic.edit-form')


        </section>

        </div> <!-- end column -->



    </div>  <!-- end container -->




@endsection