@extends('layouts.master-guest-auth')

@section('content')

    <div class="container">

        @include('layouts.blog-partials.header-blog')

        <div class="row">

            <div class="col-sm-8 blog-main">

                @include('pages.main-blog')

                @include('layouts.blog-partials.pagination')

            </div><!-- /.blog-main -->

            <div class="col-sm-3 col-sm-offset-1 blog-sidebar">

                @include('layouts.blog-partials.about-sidebar')

                @include('layouts.blog-partials.categories-sidebar')

                @include('layouts.blog-partials.archives-sidebar')

                @include('layouts.blog-partials.books-sidebar')

                @include('layouts.blog-partials.resources-sidebar')


            </div><!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </div><!-- /.container -->

@endsection