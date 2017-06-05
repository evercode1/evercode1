@extends('layouts.master-admin')


@section('content')

    <div class="container ">




        <section class="pull-right mt-25">

            <ol class="breadcrumb">

                <li><a href="/"></i> Home</a></li>
                <li><a href="/blogresource">Blog Resources</a></li>
                <li class="active">Create Resource</li>

            </ol>

        </section>



            <div class="col-md-8 col-md-offset-2">

        <h1 class="section-title">Create Resource</h1>



        <section class="white-background rounded-corners-10 pad-20">


            @include('blog-resource.create-form')


        </section>

        </div>









    </div>




@endsection