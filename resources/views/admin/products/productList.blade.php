@extends('admin.layouts.master')

@section('title','Product List')

@section('contect')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Product List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('admin#createProductList')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add Product
                            </button>
                        </a>

                    </div>
                </div>
                <div class="my-3">
                    <form action="{{route('admin#productList')}}" method="get">
                       <div class=" d-flex justify-content-between">
                        <div class="">
                            <h2>Search Key :: {{request('search_key')}}</h2>
                        </div>
                        <div>
                            <h1>Total - {{$products->total()}}</h1>
                        </div>
                        <div class=" col-4 d-flex">
                            <input type="text" name="search_key" value="{{request('search_key')}}" class="form-control">
                            <input type="submit" value="search" class="btn btn-primary">
                        </div>
                       </div>
                    </form>
                </div>
                @if (session('createSuc'))
                    <div class="alert alert-success alert-dismissible fade show col-4 offset-8" role="alert">
                        {{session('createSuc')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('deleteSuc'))
                    <div class="alert alert-danger alert-dismissible fade show col-4 offset-8" role="alert">
                        {{session('deleteSuc')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('updateSuc'))
                    <div class="alert alert-success alert-dismissible fade show col-4 offset-8" role="alert">
                        {{session('updateSuc')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive table-responsive-data2">

                           @if (count($products)==0)
                           <h3 class=' text-center text-muted my-5'>There is no Product</h3>

                           @else
                           <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th class="">IMAGE</th>
                                    <th class="">NAME</th>
                                    <th class="">CATEGORY</th>

                                    <th class="">PRICE</th>
                                    <th class="">DURATION TIME</th>
                                    <th class="">VIEW COUNT</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($products as $data)
                               <tr class="spacer"></tr>
                               <tr class="tr-shadow">

                                   <td class=" col-3">
                                    <div><img src="{{asset('storage/'.$data->image)}}" class="w-100"></div>
                                   </td>
                                   <td class=" col-2">{{$data->name}}</td>
                                   <td class=" col-2">{{$data->category_name}}</td>
                                   {{-- <td class=" col-2">{{Str::words($data->description,3,'...')}}</td> --}}
                                   <td class=" col-2">{{$data->price}} MMK</td>
                                   <td class=" col-1">{{$data->duration_time}} min</td>
                                   <td class=" col-1">{{$data->view_count}}</td>


                                   <td class=" col-1">
                                       <div class="table-data-feature">

                                           <a href="{{route('admin#detail',$data->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                           </a>
                                           <a href="{{route('admin#delete',$data->id)}}">
                                               <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                   <i class="zmdi zmdi-delete"></i>
                                               </button>
                                           </a>
                                           <a href="{{route('admin#editProductPage',$data->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </a>
                                       </div>
                                   </td>
                               </tr>
                               @endforeach
                           @endif
                        </tbody>
                    </table>
                </div>
                <div class="my-3">
            {{$products->appends(request()->query())->links()}}

                   </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
