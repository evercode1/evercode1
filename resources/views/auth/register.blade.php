@extends('layouts.master-register-login')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 mt-25">
            <div class="panel panel-default mt-25">
                <div class="panel-heading">Register</div>
                <div class="panel-body">

                    <!-- register form -->

                    @include('auth.register-form')

                    <!-- end register form -->


                    <!-- social sign in links -->

                        @include('auth.social-sign-in-links')

                    <!-- end social sign in links -->

                </div> <!-- end panel body -->

                    <!-- link to login -->

                        <div class="text-center pad-20">

                            <a href="/login">

                                    I already have a membership
                            </a>

                        </div> <!-- end text-center -->

                    <!-- end link to login -->

            </div>  <!-- end panel -->
        </div> <!-- end column -->
    </div> <!-- end row -->
</div> <!-- end container -->

@endsection
