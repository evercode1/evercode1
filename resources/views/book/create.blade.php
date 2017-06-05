@extends('layouts.master-admin')


@section('content')

    <div class="container ">




        <section class="pull-right mt-25">

            <ol class="breadcrumb">

                <li><a href="/"></i> Home</a></li>
                <li><a href="/book">Book</a></li>
                <li class="active">Create Book</li>

            </ol>

        </section>



            <div class="col-md-8 col-md-offset-2">

        <h1 class="section-title">Create Book</h1>



        <section class="white-background rounded-corners-10 pad-20">


            @include('book.create-form')


        </section>

        </div>









    </div>




@endsection