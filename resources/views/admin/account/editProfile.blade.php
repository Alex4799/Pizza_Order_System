@extends('admin.layouts.master')

@section('title','Edit Profile')

@section('contect')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Profile</h3>
                        </div>
                        <hr>
                            <form action="{{route('admin#update',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <div class="image mb-3">
                                            @if (Auth::user()->image==null)
                                            @if (Auth::user()->gender=='male')
                                                <img src="{{asset('image/default-male-image.png')}}" class=" shadow">
                                            @else
                                                <img src="{{asset('image/default-female-image.webp')}}" class=" shadow">
                                            @endif
                                            @else
                                                <img src="{{asset('storage/'.Auth::user()->image)}}" class=" shadow">
                                            @endif
                                    </div>
                                    <input type="file" name="image" id="image" class=" form-control">

                                    <div class="row">
                                        <div class=" offset-1 my-3">

                                            <button type="submit" class=" btn btn-primary"><i class="fa-solid fa-pen-to-square"></i>Update Profile</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 offset-1">

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Name</label>
                                        <input value="{{Auth::user()->name}}" type="text" name="name" class=" form-control @error('name') is-invalid @enderror" id="">

                                        @error('name')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Email</label>
                                        <input value="{{Auth::user()->email}}" type="email" name="email" class=" form-control @error('email') is-invalid @enderror" id="">
                                        @error('email')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Phone</label>
                                        <input value="{{Auth::user()->phone}}" type="number" name="phone" class=" form-control @error('phone') is-invalid @enderror" id="">
                                        @error('phone')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Address</label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="1">{{Auth::user()->address}}</textarea>
                                        @error('address')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Gender</label>
                                        <select name="gender" id="" class=" form-control @error('gender') is-invalid @enderror">
                                            <option value="">Choose Gender</option>
                                            <option value="male" @if (Auth::user()->gender || old('gender')=='male') selected @endif>Male</option>
                                            <option value="female" @if (Auth::user()->gender || old('gender')=='female') selected @endif>Female</option>
                                        </select>
                                        @error('gender')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">role</label>
                                        <input value="{{Auth::user()->role}}" type="text" name="" class=" form-control" id="" disabled>
                                    </div>
                                </div>
                                </div>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
