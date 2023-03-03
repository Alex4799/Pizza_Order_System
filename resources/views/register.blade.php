@extends('layouts.master')

@section('title')
    Register Page
@endsection

@section('contect')

    <div class="">
        <form action="{{route('register')}}" method="post">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" type="text" name="name" placeholder="Username">
            </div>
            @error('name')
                <small class=" text-danger">{{$message}}</small>
            @enderror

            <div class="form-group">
                <label>Email Address</label>
                <input class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" type="email" name="email" placeholder="Email">
            </div>
            @error('email')
                <small class=" text-danger">{{$message}}</small>
            @enderror

            <div class="form-group">
                <label>Phone</label>
                <input class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}" type="number" name="phone" placeholder="Phone">
            </div>
            @error('phone')
                <small class=" text-danger">{{$message}}</small>
            @enderror

            <div class="form-group">
                <label>Address</label>
                <input class="form-control @error('address') is-invalid @enderror" value="{{old('address')}}" type="text" name="address" placeholder="Address">
            </div>
            @error('address')
                <small class=" text-danger">{{$message}}</small>
            @enderror

            <div class="form-group @error('gender') is-invalid @enderror">
                <label>Gender</label>
                <select class=" form-control" name='gender'>
                <option value='male'>Male</option>
                <option value='female'>Female</option>
                </select>
            </div>
            @error('gender')
                <small class=" text-danger">{{$message}}</small>
            @enderror

            <div class="form-group">
                <label>Password</label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
            </div>
            @error('password')
                <small class=" text-danger">{{$message}}</small>
            @enderror

            <div class="form-group">
                <label>Password</label>
                <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" placeholder="Confirm Password">
            </div>
            @error('password_confirmation')
                <small class=" text-danger">{{$message}}</small>
            @enderror

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{route('auth#loginPage')}}">Sign In</a>
            </p>
        </div>
    </div>

@endsection
