@extends('layouts.master-admin')

@section('title')

    <title>Edit a User</title>

@endsection

@section('content')

    <div class="container">



        <div class="col-md-8 col-md-offset-2 mt-25">

            <div class="pull-right">



                <ol class='breadcrumb'>
                    <li><a href='/'>Home</a></li>
                    <li><a href='/user'>Users</a></li>
                    <li><a href='/user/{{ $user->id }}'>{{ $user->name }}</a></li>
                </ol>



            </div>

    <h2>Edit User</h2>

    <hr/>

    @include('user.edit-form')

    </div> <!-- end column -->

    </div> <!-- end container -->

@endsection