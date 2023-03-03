@extends('user.layout.master')

@section('title','Cart')

@section('contect')

        <!-- Cart Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-lg-8 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th></th>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle" id="tableData">

                            @foreach ($cart as $c)
                            <tr>
                                <input type="hidden" id="cartId" value="{{$c->id}}">
                                <input type="hidden" id="price" value="{{$c->product_price}}">
                                <input type="hidden" id="userId" value="{{Auth::user()->id}}">
                                <input type="hidden" id="productId" value="{{$c->product_id}}">
                                <td class="align-middle"><img src="{{asset('storage/'.$c->image)}}" class=" img-thumbnail shadow-sm w-50" alt=""></td>
                                <td class="align-middle">{{$c->product_name}}</td>
                                <td class="align-middle">{{$c->product_price}} MMK</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm border-0 text-center" disabled id='count' value="{{$c->qty}}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{$c->product_price*$c->qty}} MMK</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger remove"><i class="fa fa-times"></i></button></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6 id="totalPrice">{{$total}} MMK</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Delivery</h6>
                                <h6 class="font-weight-medium">3000 MMK</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5 id="finalPrice">{{$total+3000}} MMK</h5>
                            </div>
                            <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="order">Order</button>
                            <button class="btn btn-block btn-danger font-weight-bold my-3 py-3 removeAll" id="removeAll">Delete Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->


@endsection

@section('scriptSourcecode')
    <script src="{{asset('js/cart.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#order').click(function(){
                $random=Math.floor(Math.random()*100001);
                $orderList=[];
                $('#tableData tr').each(function(index,row){
                    $orderList.push({
                        'user_id': $(row).find('#userId').val(),
                        'product_id':$(row).find('#productId').val(),
                        'qty':$(row).find('#count').val(),
                        'total':$(row).find('#total').html().replace('MMK','')*1,
                        'orderCode':"POS"+$random,
                    })
                })
                $.ajax({
                    type:'get',
                    url:'http://127.0.0.1:8000/user/order/list',
                    dataType:'json',
                    data:Object.assign({},$orderList),
                    success:function(data){
                        if(data.status=='true'){
                            window.location.href = "http://127.0.0.1:8000/user/home";
                        }
                    }
                })
            })

            $('.remove').click(function(){
                $parents=$(this).parents('tr');
                $parents.remove();
                $cartId=$parents.find('#cartId').val();
                $totalPrice=0;
                $('#tableData tr').each(function(index,row){
                    $totalPrice+=Number($(row).find('#total').html().replace('MMK',''));
                })
                $('#totalPrice').html(`${$totalPrice} MMK`);
                $('#finalPrice').html(`${$totalPrice+3000} MMK`);

                $.ajax({
                    type:'get',
                    url:'http://127.0.0.1:8000/user/cart/remove',
                    dataType:'json',
                    data:{'cartId':$cartId}
                })
            })

            $('.removeAll').click(function(){

                $parents=$('tbody');
                $parents.remove()
                 $totalPrice=0
                $('#tableData tr').each(function(index,row){
                    $totalPrice+=Number($(row).find('#total').html().replace('MMK',''));
                })
                $('#totalPrice').html(`${$totalPrice} MMK`);
                $('#finalPrice').html(`${$totalPrice+3000} MMK`);

                $.ajax({
                    type:'get',
                    url:'http://127.0.0.1:8000/user/cart/removeAll',
                    dataType:'json',
                })
            })
        })
    </script>
@endsection
