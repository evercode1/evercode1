<!DOCTYPE html>
<html lang="en">
<head>

    @include('layouts.master-partials.meta')

    @yield('title')

    @include('layouts.master-partials.css')

    @include('layouts.master-partials.shiv')

</head>

<body>

<div id="app">

    @include('layouts.master-partials.top-nav')

    <div class="container">

        @yield('blog-header')

        <div class="row">

    @yield('content')

            <div class="col-sm-3 col-sm-offset-1 blog-sidebar">

                @include('layouts.blog-partials.sidebars')


            </div><!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </div><!-- /.container -->

    @include('layouts.master-partials.footer')

    @include('layouts.master-partials.scripts')

</div>

</body>
</html>
