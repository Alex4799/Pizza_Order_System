@extends('admin.layouts.master')

@section('title','USER LIST')

@section('contect')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">User List</h2>

                        </div>
                    </div>

                </div>
                <div class="my-3">
                    <form action="{{route('admin#userList')}}" method="get">
                       <div class=" d-flex justify-content-between">
                        <div class="">
                            <h2>Search Key :: {{request('search_key')}}</h2>
                        </div>
                        <div>
                            <h1>Total - {{$userList->total()}}</h1>
                        </div>
                        <div class=" col-4 d-flex">
                            <input type="text" name="search_key" value="{{request('search_key')}}" class="form-control">
                            <input type="submit" value="search" class="btn btn-primary">
                        </div>
                       </div>
                    </form>
                </div>

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
                               @foreach ($userList as $data)
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
                                   <input type="hidden" id="userId" value="{{$data->id}}">
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
                                        <a href="{{route('admin#userAccountDelete',$data->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>
                                       </div>
                                   </td>
                               </tr>
                               @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="my-3">
            {{$userList->appends(request()->query())->links()}}

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
           $userId=$parents.find('#userId').val();
          $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/user/change/role',
            dataType:'json',
            data:{
                'userId':$userId,
                'changeRole':$changeRole,
            },
            success:function(response){
                location.reload()
            }
        })
        })
    })
    </script>

@endsection
