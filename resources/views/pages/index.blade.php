@extends('layouts.master-guest-auth')

@section('blog-header')

    @include('layouts.blog-partials.blog-header')

@endsection

@section('content')



            <div class="col-sm-8 blog-main">

                @include('pages.main-blog')

                @include('layouts.blog-partials.pagination')

            </div><!-- /.blog-main -->



@endsection