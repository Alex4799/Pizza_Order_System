@extends('admin.layouts.master')

@section('title','ADMIN LIST')

@section('contect')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Admin List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="#">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add Category
                            </button>
                        </a>

                    </div>
                </div>
                <div class="my-3">
                    <form action="{{route('admin#list')}}" method="get">
                       <div class=" d-flex justify-content-between">
                        <div class="">
                            <h2>Search Key :: {{request('search_key')}}</h2>
                        </div>
                        <div>
                            <h1>Total - {{$adminList->total()}}</h1>
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

                @if (session('deleteSucc'))
                    <div class="alert alert-danger alert-dismissible fade show col-4 offset-8" role="alert">
                        {{session('deleteSucc')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('changeRoleSucc'))
                    <div class="alert alert-warning alert-dismissible fade show col-4 offset-8" role="alert">
                        {{session('changeRoleSucc')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive table-responsive-data2">

                           <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>IMAGE</th>
                                    <th>NAME</th>
                                    <th>GENDER</th>
                                    <th>EMAIL</th>
                                    <th>PHONE</th>
                                    <th>ADDRESS</th>
                                    <th>ROLE</th>

                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($adminList as $data)
                               <tr class="spacer"></tr>
                               <tr class="tr-shadow">
                                   <td>
                                        @if ($data->image==null)
                                            @if ($data->gender=='male')
                                                <img src="{{asset('image/default-male-image.png')}}" class=" shadow">
                                            @else
                                                <img src="{{asset('image/default-female-image.webp')}}" class=" shadow">
                                            @endif
                                        @else
                                            <img src="{{asset('storage/'.$data->image)}}" class=" shadow">
                                        @endif
                                   </td>
                                   <input type="hidden" id="adminId" value="{{$data->id}}">
                                   <td>{{$data->name}}</td>
                                   <td>{{$data->gender}}</td>
                                   <td>{{$data->email}}</td>
                                   <td>{{$data->phone}}</td>
                                   <td>{{$data->address}}</td>
                                   <td class="col-2">
                                    <select id="role" class="changeRole form-control">
                                        <option value="admin" @if ($data->role=='admin') selected @endif>Admin</option>
                                        <option value="user" @if ($data->role=='user') selected @endif>User</option>
                                    </select>
                                   </td>
                                   <td>
                                       <div class="table-data-feature">

                                           @if (Auth::user()->id != $data->id)
                                                <a href="{{route('adminList#delete',$data->id)}}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>

                                           @endif

                                       </div>
                                   </td>
                               </tr>
                               @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="my-3">
            {{$adminList->appends(request()->query())->links()}}

                   </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptCode')
    <script>
    $(document).ready(function(){
        $('.changeRole').change(function(){
           $parents=$(this).parents('tr');
           $changeRole=$parents.find('#role').val();
           $adminId=$parents.find('#adminId').val();
          $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/account/changeRole',
            dataType:'json',
            data:{
                'adminId':$adminId,
                'changeRole':$changeRole,
            },
            success:function(response){
                console.log(response.message);
            }
        })
        })
    })
    </script>

@endsection
