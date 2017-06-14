@extends('layouts.master-admin')

@section('meta')

    @include('layouts.admin-partials.pie-chart')

@endsection

@section('title')

    <title>The Admin Page</title>

@endsection

@section('content')



    <div class="col-md-6 col-md-offset-4 mt-25">



    @include('admin.grid')

    </div>

@endsection