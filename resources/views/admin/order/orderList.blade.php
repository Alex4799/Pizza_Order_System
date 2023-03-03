@extends('admin.layouts.master')

@section('title','Order List')

@section('contect')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>
                        </div>
                    </div>
                </div>
                <div class="my-3">
                    <form action="{{route('admin#orderList')}}" method="get">
                       <div class=" d-flex justify-content-between">
                        <div class="col-4">

                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  @if ($status=='0')
                                    Pending
                                  @elseif ($status=='1')
                                    Success
                                  @elseif ($status=='2')
                                    Reject
                                  @else
                                      All
                                  @endif
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="{{route('admin#orderStatus','all')}}">All</a></li>
                                  <li><a class="dropdown-item" href="{{route('admin#orderStatus','0')}}">Pending</a></li>
                                  <li><a class="dropdown-item" href="{{route('admin#orderStatus','1')}}">Success</a></li>
                                  <li><a class="dropdown-item" href="{{route('admin#orderStatus','2')}}">Reject</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-4">
                            <h1>Total - {{count($order)}}</h1>
                        </div>
                        <div class=" col-4 d-flex">
                            <input type="text" name="search_key" value="{{request('search_key')}}" class="form-control">
                            <input type="submit" value="search" class="btn btn-primary">
                        </div>
                       </div>
                    </form>
                </div>

                <div class="table-responsive table-responsive-data2">

                           @if (count($order)==0)
                           <h3 class=' text-center text-muted my-5'>There is no Order</h3>

                           @else
                           <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>USER NAME</th>
                                    <th>ORDER DATE</th>
                                    <th>ORDER CODE</th>
                                    <th>AMOUNT</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody id="orderContainer">
                                @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <input type="hidden" value="{{$o->id}}" id="orderId">
                                        <td>{{$o->user_name}}</td>
                                        <td>{{$o->created_at->format('F-m-Y')}}</td>
                                        <td><a href="{{route('admin#orderListInfo',$o->orderCode)}}">{{$o->orderCode}}</a></td>
                                        <td>{{$o->total_price}} MMK</td>
                                        <td>
                                            <select class=' form-control changeStatus' id="changeStatus">
                                                <option value="0" class="" @if ($o->status==0) selected @endif>Pending</option>
                                                <option value="1" class="" @if ($o->status==1) selected @endif>Success</option>
                                                <option value="2" class="" @if ($o->status==2) selected @endif>Reject</option>

                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                    @endif
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
            // $('#orderStatus').change(function(){
            //     $status=$('#orderStatus').val();

            //     $.ajax({
            //         type:'get',
            //         url:'http://127.0.0.1:8000/admin/order/status',
            //         dataType:'json',
            //         data:{'orderStatus':$status},
            //         success:function(response){
            //             $order='';
            //             for (let $i = 0; $i < response.length; $i++) {
            //                 if (response[$i].status==0) {
            //                     $orderStatus=`
            //                     <select class=' form-control changeStatus' id="changeStatus">
            //                         <option value="0" selected >Pending</option>
            //                         <option value="1" >Success</option>
            //                         <option value="2" >Reject</option>
            //                     </select>
            //                     `
            //                 }else if(response[$i].status==1) {
            //                     $orderStatus=`
            //                     <select class=' form-control changeStatus' id="changeStatus">
            //                         <option value="0">Pending</option>
            //                         <option value="1" selected>Success</option>
            //                         <option value="2" >Reject</option>
            //                     </select>
            //                     `
            //                 }else if(response[$i].status==2) {
            //                     $orderStatus=`
            //                     <select class=' form-control changeStatus' id="changeStatus">
            //                         <option value="0">Pending</option>
            //                         <option value="1">Success</option>
            //                         <option value="2" selected>Reject</option>
            //                     </select>
            //                     `
            //                 }

            //                 $orderTime=new Date(response[$i].created_at)
            //                 $months=['January','February','March','April','May','June','July','August','September','October','November','December']
            //                 $orderMonth=$months[$orderTime.getMonth()];
            //                 $orderDate=$orderTime.getDate();
            //                 $orderYear=$orderTime.getFullYear();

            //                 $currentTime=`${$orderMonth}-${$orderDate}-${$orderYear}`

            //                 $order+=`
            //                 <tr class="tr-shadow">
            //                     <input type="hidden" value="${response[$i].id}" id="orderId">
            //                             <td>${response[$i].user_name}</td>
            //                             <td>${$currentTime}</td>
            //                             <td>${response[$i].orderCode}</td>
            //                             <td>${response[$i].total_price} MMK</td>
            //                             <td>
            //                                 ${$orderStatus}
            //                             </td>
            //                         </tr>
            //                 `
            //             }
            //             $('#orderContainer').html($order)
            //         }
            //     })
            // })

            $('.changeStatus').change(function(){
                $parents=$(this).parents('tr');
                $orderId=$parents.find('#orderId').val();
                $changeStatus=$parents.find('#changeStatus').val();
                $data={
                    'order_id':$orderId,
                    'changeStatus':$changeStatus,
                }
                $.ajax({
                    type:'get',
                    url:'http://127.0.0.1:8000/admin/order/changeStatus',
                    dataType:'json',
                    data:$data,
                    success:function(response){
                    }
                })
            })
        })
    </script>
@endsection
