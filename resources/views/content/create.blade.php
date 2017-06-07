@extends('layouts.master-admin')

@section('meta')

    <script src="/ckeditor/ckeditor.js"></script>

@endsection

@section('content')

    <div class="container ">




        <section class="pull-right mt-25">

            <ol class="breadcrumb">

                <li><a href="/"></i> Home</a></li>
                <li><a href="/content">Content</a></li>
                <li class="active">Create Content</li>

            </ol>

        </section>



            <div class="col-md-8 col-md-offset-2">

        <h1 class="section-title">Create Content</h1>



        <section class="white-background rounded-corners-10 pad-20">


            @include('content.create-form')


        </section>

        </div>

    </div>

@endsection

@section('scripts')

    <script>
        CKEDITOR.replace( 'body' );
    </script>

@endsection