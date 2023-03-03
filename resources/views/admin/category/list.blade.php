@extends('admin.layouts.master')

@section('title','Category')

@section('contect')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Category List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('category#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add Category
                            </button>
                        </a>

                        @if (count($contact)!=0)
                        <a href="{{route('admin#contactListPage')}}" class="btn btn-white position-relative">
                            <i class="fa-regular fa-bell fs-4"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                              {{count($contact)}}
                              <span class="visually-hidden">unread messages</span>
                            </span>
                          </a>
                        @endif
                    </div>

                </div>
                <div class="my-3">
                    <form action="{{route('category#list')}}" method="get">
                       <div class=" d-flex justify-content-between">
                        <div class="">
                            <h2>Search Key :: {{request('search_key')}}</h2>
                        </div>
                        <div>
                            <h1>Total - {{$categoryList->total()}}</h1>
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

                <div class="table-responsive table-responsive-data2">

                           @if (count($categoryList)==0)
                           <h3 class=' text-center text-muted my-5'>There is no Category</h3>

                           @else
                           <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>DATE</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($categoryList as $data)
                               <tr class="spacer"></tr>
                               <tr class="tr-shadow">
                                   <td class=" col-3">{{$data->id}}</td>
                                   <td class=" col-4">{{$data->name}}</td>
                                   <td class=" col-4">{{$data->created_at->format('d/m/Y')}}</td>
                                   <td class=" col-1">
                                       <div class="table-data-feature">

                                           <a href="{{route('category#editPage',$data->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                           </a>
                                           <a href="{{route('category#delete',$data->id)}}">
                                               <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                   <i class="zmdi zmdi-delete"></i>
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
            {{$categoryList->appends(request()->query())->links()}}

                   </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
