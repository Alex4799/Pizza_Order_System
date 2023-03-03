@extends('admin.layouts.master')

@section('title','Change Role')

@section('contect')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Role</h3>
                        </div>
                        <hr>
                            <form action="{{route('adminList#changeRole',$data->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <div class="image mb-3">
                                            @if ($data->image==null)
                                            @if ($data->gender=='male')
                                                <img src="{{asset('image/default-male-image.png')}}" class=" shadow">
                                            @else
                                                <img src="{{asset('image/default-female-image.webp')}}" class=" shadow">
                                            @endif
                                            @else
                                                <img src="{{asset('storage/'.$data->image)}}" class=" shadow">
                                            @endif
                                    </div>


                                    <div class="row">
                                        <div class=" offset-1 my-3">

                                            <button type="submit" class=" btn btn-primary"><i class="fa-solid fa-pen-to-square"></i>Update Profile</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 offset-1">

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Name</label>
                                        <input value="{{$data->name}}" type="text" name="name" disabled class=" form-control @error('name') is-invalid @enderror" id="">

                                        @error('name')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">role</label>
                                        <select name="role" class=" form-control" id="">
                                            <option value="admin" @if ($data->role=='admin') selected @endif>Admin</option>
                                            <option value="user" @if ($data->role=='user') selected @endif>User</option>
                                        </select>
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Email</label>
                                        <input value="{{$data->email}}" type="email" name="email" disabled class=" form-control @error('email') is-invalid @enderror" id="">
                                        @error('email')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Phone</label>
                                        <input value="{{$data->phone}}" type="number" name="phone" disabled class=" form-control @error('phone') is-invalid @enderror" id="">
                                        @error('phone')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Address</label>
                                        <textarea name="address" disabled class="form-control @error('address') is-invalid @enderror" cols="30" rows="1">{{$data->address}}</textarea>
                                        @error('address')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Gender</label>
                                        <select name="gender" disabled id="" class=" form-control @error('gender') is-invalid @enderror">
                                            <option value="">Choose Gender</option>
                                            <option value="male" @if ($data->gender || old('gender')=='male') selected @endif>Male</option>
                                            <option value="female" @if ($data->gender || old('gender')=='female') selected @endif>Female</option>
                                        </select>
                                        @error('gender')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
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
