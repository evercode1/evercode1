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



        @yield('content')



    @include('layouts.master-partials.footer')

    @include('layouts.master-partials.scripts')

</div>

</body>
</html>
