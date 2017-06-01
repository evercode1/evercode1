@extends('layouts.master-register-login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 mt-25">
            <div class="panel panel-default mt-25">
                <div class="panel-heading">Login</div>
                <div class="panel-body">

                    <!-- login form -->

                    @include('auth.login-form')

                    <!-- end login form -->

                    <!-- social sign in links -->

                    @include('auth.social-sign-in-links')

                    <!-- end social sign in links -->

                    <!-- password reset and register links -->

                    <div class="text-center">

                     <a href="{{ url('/password/reset') }}">I forgot my password</a><br>
                     <a href="/register" class="text-center">Register a new membership</a>

                    </div>  <!-- end text-center -->

                    <!-- end password reset and register links -->

                </div>  <!-- end panel body -->
            </div> <!-- end panel -->
        </div> <!-- end column -->
    </div> <!-- end row -->
</div> <!-- end container -->
@endsection
