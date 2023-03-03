@extends('admin.layouts.master')

@section('title','Product Detail')

@section('contect')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class=" text-decoration-none text-dark" onclick="history.back()"><i class="fa-solid fa-arrow-left"></i></div>
                        </div>
                        @if (session('detailUpdate'))
                            <div class="alert alert-success alert-dismissible fade show col-6 offset-6" role="alert">
                                {{session('detailUpdate')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-3 offset-1">
                                    <div class="image">
                                        <img src="{{asset('storage/'.$product->image)}}" alt="{{Auth::user()->name}}" />
                                </div>
                            </div>
                            <div class="col-6 offset-1">
                                <div class=" m-3"><h3><i class="fa-solid fa-pizza-slice me-1"></i>{{$product->name}}</h3></div>
                                <div class=" m-3"><h3>({{$product->category_name}})</h3></div>
                                <span class=" m-3"><i class="fa-solid fa-money-bill-wave me-1"></i>{{$product->price}} MMK</span>
                                <span class=" m-3"><i class="fa-solid fa-hourglass-half me-1"></i>{{$product->duration_time}} min</span>
                                <span class=" m-3"><i class="fa-solid fa-eye me-1"></i>{{$product->view_count}}</span>
                                <div class=" m-3 text-muted">{{$product->description}}</div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
