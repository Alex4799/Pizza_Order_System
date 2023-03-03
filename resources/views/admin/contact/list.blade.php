@extends('admin.layouts.master')

@section('title','Contact List')

@section('contect')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
             <div class="table-responsive table-responsive-data2">

                           <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody id="orderContainer">
                                @foreach ($contacts as $data)
                                    <tr class="tr-shadow  @if ($data->status==0) bg-warning @endif">
                                        <td></td>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->email}}</td>
                                        <td>{{$data->created_at->format('F-m-Y')}}</td>
                                        <td>
                                            <a href="{{route('admin#contactInfo',$data->id)}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                    <i class="fa-solid fa-eye fs-4"></i>
                                                </button>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

