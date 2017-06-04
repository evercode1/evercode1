@extends('layouts.master-register-login')

@section('content')

    <div class="container">

    <div class="alert alert-danger alert-dismissible alert-important mt-25" role="alert">

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>

        <strong>Oh Snap!</strong> {{ $exception->getMessage() }} Credentials Do Not Match...

    </div>

    </div>

@endsection