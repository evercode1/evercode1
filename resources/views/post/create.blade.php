@extends('layouts.master-admin')

@section('meta')

    <script src="/ckeditor/ckeditor.js"></script>

    @endsection

@section('content')

    <div class="container ">




        <section class="pull-right mt-25">

            <ol class="breadcrumb">

                <li><a href="/"></i> Home</a></li>
                <li><a href="/post">Posts</a></li>
                <li class="active">Create Post</li>

            </ol>

        </section>



            <div class="col-md-8 col-md-offset-2">

        <h1 class="section-title">Create Post</h1>



        <section class="white-background rounded-corners-10 pad-20">


            @include('post.create-form')


        </section>

        </div>









    </div>




@endsection