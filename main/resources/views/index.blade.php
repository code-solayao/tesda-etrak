@extends('shared._layout')

@section('styles')
    <style>
        .content-centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
@endsection
@section('content')
    <div class="text-center content-centered">
        <h1 class="display-4">Welcome to the <strong>E-TRAK</strong> website by TESDA</h1>
        <a class="btn btn-primary" href="login/index.php">Go to Login</a>
    </div>
@endsection