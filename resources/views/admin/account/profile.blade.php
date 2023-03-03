@extends('admin.layouts.master')

@section('title','Profile')

@section('contect')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Profile</h3>
                        </div>
                        @if (session('profileUpdate'))
                            <div class="alert alert-success alert-dismissible fade show col-6 offset-6" role="alert">
                                {{session('profileUpdate')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <hr>
                        <div class="row">
                            <div class="col-3 offset-1">
                                    <div class="image">
                                        <a href="#">
                                            @if (Auth::user()->image==null)
                                            @if (Auth::user()->gender=='male')
                                                <img src="{{asset('image/default-male-image.png')}}" class=" shadow">
                                            @else
                                                <img src="{{asset('image/default-female-image.webp')}}" class=" shadow">
                                            @endif
                                            @else
                                                <img src="{{asset('storage/'.Auth::user()->image)}}" class=" shadow">
                                            @endif
                                    </a>
                                </div>
                            </div>
                            <div class="col-6 offset-1">
                                <div class=" my-3"><h3><i class="fa-solid fa-user me-3"></i>{{Auth::user()->name}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-envelope me-3"></i>{{Auth::user()->email}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-phone me-3"></i>{{Auth::user()->phone}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-map-location me-3"></i>{{Auth::user()->address}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-mars-and-venus me-3"></i>{{Auth::user()->gender}}</h3></div>
                                <div class=" my-3"><h3><i class="fa-solid fa-user-clock me-3"></i>{{Auth::user()->created_at->format('d-m-Y')}}</h3></div>

                            </div>
                        </div>
                        <div class="row">
                            <div class=" offset-1">
                                <a href="{{route('admin#editPage')}}" class=" btn btn-primary"><i class="fa-solid fa-pen-to-square"></i>Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
