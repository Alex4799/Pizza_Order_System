@extends('admin.layouts.master')

@section('title','Create Product')

@section('contect')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{route('admin#productList')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Product</h3>
                        </div>
                        <hr>
                        <form action="{{route('admin#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="control-label mb-1">Name</label>
                                <input id="cc-pament" value="{{old('name')}}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                            </div>
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div class="form-group">
                                <label class="control-label mb-1">Category</label>
                                <select name="category" id="" class=" form-control @error('name') is-invalid @enderror">
                                    <option value="">Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div class="form-group">
                                <label class="control-label mb-1">Image</label>
                                <input id="cc-pament" value="{{old('image')}}" name="image" type="file" class="form-control @error('image') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Seafood...">
                            </div>
                            @error('image')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div class="form-group">
                                <label class="control-label mb-1">Description</label>
                                <textarea name="description" placeholder="Enter Description..." class="form-control @error('description') is-invalid @enderror" cols="30" rows="1">{{old('description')}}</textarea>
                            </div>
                            @error('description')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div class="form-group">
                                <label class="control-label mb-1">Price (MMK)</label>
                                <input id="cc-pament" value="{{old('price')}}" name="price" type="number" class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Price...">
                            </div>
                            @error('price')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div class="form-group">
                                <label class="control-label mb-1">Duration Time (min)</label>
                                <input id="cc-pament" value="{{old('durationTime')}}" name="durationTime" type="number" class="form-control @error('durationTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Duration time...">
                            </div>
                            @error('durationTime')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
