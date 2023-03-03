@extends('layouts.master')

@section('title')
    Login Page
@endsection

@section('contect')

<div class="login-form">
    <form action="{{route('login')}}" method="post">
        @csrf
        <div class="form-group">
            <label>Email Address</label>
            <input class="@error('email') is-invalid @enderror form-control" value="{{old('email')}}" type="email" name="email" placeholder="Email">
        </div>
        @error('email')
            <small class=" text-danger">{{$message}}</small>
        @enderror
        <div class="form-group">
            <label>Password</label>
            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
        </div>
        @error('password')
            <small class=" text-danger">{{$message}}</small>
        @enderror

        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

    </form>
    <div class="register-link">
        <p>
            Don't you have account?
            <a href="{{route('auth#registerPage')}}">Sign Up Here</a>
        </p>
    </div>
</div>

@endsection
