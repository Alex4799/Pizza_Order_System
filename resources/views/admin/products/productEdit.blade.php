@extends('admin.layouts.master')

@section('title','Product Edit')

@section('contect')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Product</h3>
                        </div>
                        <hr>
                            <form action="{{route('admin#Productupdate')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <div class="image mb-3">

                                            <img src="{{asset('storage/'.$product->image)}}" />

                                    </div>
                                    <input type="file" name="image" id="image" class=" form-control">

                                    <div class="row">
                                        <div class=" offset-1 my-3">

                                            <button type="submit" class=" btn btn-primary"><i class="fa-solid fa-pen-to-square"></i>Update Product</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 offset-1">

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Name</label>
                                        <input value="{{$product->name}}" type="text" name="name" class=" form-control @error('name') is-invalid @enderror" id="">

                                        @error('name')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Price</label>
                                        <input value="{{$product->price}}" type="number" name="price" class=" form-control @error('price') is-invalid @enderror" id="">
                                        @error('price')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Duration Time</label>
                                        <input value="{{$product->duration_time}}" type="number" name="durationTime" class=" form-control @error('durationTime') is-invalid @enderror" id="">
                                        @error('durationTime')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Description</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">{{$product->description}}</textarea>
                                        @error('description')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Category</label>
                                        <select name="category" id="" class=" form-control @error('category') is-invalid @enderror">
                                            <option value="">Choose category</option>
                                           @foreach ($categories as $category)
                                               <option value="{{$category->id}}" @if ($category->id == $product->category_id) selected @endif>{{$category->name}}</option>
                                           @endforeach
                                        </select>
                                        @error('category')
                                        <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">View Count</label>
                                        <input value="{{$product->view_count}}" type="text" name="" class=" form-control" id="" disabled>
                                    </div>

                                    <div class=" my-3">
                                        <label for="" class=" control-label">Created At</label>
                                        <input value="{{$product->created_at}}" type="text" name="" class=" form-control" id="" disabled>
                                    </div>

                                    <div>
                                        <input type="hidden" name="id" value="{{$product->id}}" >
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
