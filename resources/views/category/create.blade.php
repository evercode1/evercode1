@extends('layouts.master-admin')


@section('content')

    <div class="container ">




        <section class="pull-right mt-25">

            <ol class="breadcrumb">

                <li><a href="/"></i> Home</a></li>
                <li><a href="/category">Categories</a></li>
                <li class="active">Create Category</li>

            </ol>

        </section>



            <div class="col-md-8 col-md-offset-2">

        <h1 class="section-title">Create Category</h1>



        <section class="white-background rounded-corners-10 pad-20">


            @include('category.create-form')


        </section>

        </div>









    </div>




@endsection