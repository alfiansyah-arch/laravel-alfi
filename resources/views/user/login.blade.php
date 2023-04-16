@extends('layout')
@section('content')
<div class="login">
<div class="row justify-content-center">
    <div class="col-md-6">
        @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
        @endif
        <form action="{{ route('login.action') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email"/>
            </div>
            <div class="mb-3">
                <input class="form-control" type="password" name="password" placeholder="Password"/>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary">Login</button>
                <!-- <a class="btn btn-danger" href="{{ route('home') }}">Back</a> -->
            </div>
            <div class="mb-3">
                <p>Tidak punya akun ? Buat akun sekarang <a href="{{ route('register') }}">Register<a></p>
            </div>
        </form>
    </div>
</div>
</div>
@endsection