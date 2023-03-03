@extends('admin.layouts.master')

@section('title','Order Info')

@section('contect')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="row col-6">
                    <div class=" card">
                        <div class=" card-body">
                            <h2>Order Info</h2>
                        </div>
                        <div class=" card-body">
                            <div class="row mb-3">
                                <div class="col"><i class="fa-regular fa-user me-2"></i>Name</div>
                                <div class="col">{{$orderList[0]->user_name}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                                <div class="col">{{$orderList[0]->orderCode}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-regular fa-clock me-2"></i>Order Date</div>
                                <div class="col">{{$orderList[0]->created_at->format('F-m-Y')}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-money-bill-wave me-2"></i>Total</div>
                                <div class="col">{{$order->total_price}} MMK <small class=" text-warning">(Include Delivery Charges)</small></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="table-responsive table-responsive-data2">

                           <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Order ID</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>Quentity</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody id="orderContainer">
                                @foreach ($orderList as $o)
                                    <tr class="tr-shadow">
                                        <td></td>
                                        <td>{{$o->id}}</td>
                                        <td class=" col-2"><img src="{{asset('storage/'.$o->product_image)}}" class=" img-thumbnail shadow"></td>
                                        <td>{{$o->product_name}}</td>
                                        <td>{{$o->created_at->format('F-m-Y')}}</td>
                                        <td>{{$o->qty}}</td>
                                        <td>{{$o->total}}</td>
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

