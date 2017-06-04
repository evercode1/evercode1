@extends('layouts.master-admin')

@section('title')

    <title>The Admin Page</title>

@endsection

@section('content')



    <div class="col-md-6 col-md-offset-4">

        <h1>Admin</h1>

    @include('admin.grid')

    </div>

@endsection