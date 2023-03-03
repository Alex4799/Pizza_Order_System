@extends('user.layout.master')

@section('title','Home')

@section('contect')


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="position-relative text-uppercase mb-3"><span class=" pr-3">Filter by Categories</span></h5>

                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class=" d-flex align-items-center justify-content-between mb-3">
                            <label class="" for="price-all">Category</label>
                        </div>

                        <div class=" d-flex align-items-center justify-content-between mb-3 p-2 @if ($id==0) bg-warning @endif">
                            <a href="{{route('user#categoryGroup',0)}}" class="text-dark w-100"><label class="">All</label></a>
                        </div>

                        @foreach ($categories as $c)

                        <div class=" d-flex align-items-center justify-content-between mb-3 p-2 @if ($c->id==$id) bg-warning @endif">
                            <a href="{{route('user#categoryGroup',$c->id)}}" class="text-dark w-100"><label class="" for="category-{{$c->id}}">{{$c->name}}</label></a>
                        </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->

                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->

            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{route('user#cartPage')}}" type="button" class="btn btn-secondary text-white position-relative">
                                    Cart<i class="fa-solid fa-cart-plus"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                      {{count($cart)}}
                                      <span class="visually-hidden">unread messages</span>
                                    </span>
                                  </a>

                                  <a href="{{route('user#orderHistoryPage')}}" type="button" class="btn btn-secondary text-white position-relative ms-3">
                                    Order History<i class="fa-solid fa-cart-plus"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                      {{count($order)}}
                                      <span class="visually-hidden">unread messages</span>
                                    </span>
                                  </a>
                            </div>
                             <div class="">
                                <div class="">
                                    <select name="sort" id="sort" class="form-control">
                                        <option value="">Sorting</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>

                        </div>
                    </div>
                </div>
                    <div class="row" id="productContainer">
                       @if (count($products)!=0)
                        @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4" id="product">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{asset('storage/'.$product->image)}}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href="{{route('user#productDetail',$product->id)}}"><i class="fa-solid fa-eye"></i></a>
                                        </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">{{$product->name}}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{$product->price}} kyats</h5>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                       @else
                           <div class="container text-center bg-secondary p-5">
                            <h1>There is no product</h1>
                           </div>
                       @endif
                    </div>



                </div>
            </div>

            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->



@endsection
@section('scriptSourcecode')
    <script>
        $(document).ready(function(){
    // $.ajax({
    //     type:'get',
    //     url:'http://127.0.0.1:8000/ajax',
    //     dataType:'json',
    //     success:function(data){
    //         console.log(data);
    //     }
    // })
    $sort=$('#sort');

    $sort.change(function(){

        $sortStatus=$sort.val();
        if ($sortStatus=='asc') {
            $.ajax({
                type:'get',
                url:'http://127.0.0.1:8000/user/ajax',
                dataType:'json',
                data:{'status':'asc'},
                success:function(data){
                    $product='';
                    for (let $i = 0; $i < data.length; $i++) {
                        // console.log(data[$i].name);
                       $product+=`
                       <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4" id="product">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{asset('storage/${data[$i].image}')}}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-eye"></i></a>
                                        </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${data[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${data[$i].price} kyats</h5>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                       `
                    }
                    $('#productContainer').html($product)
                }
            })

        } else if($sortStatus=='desc') {
            $.ajax({
                type:'get',
                url:'http://127.0.0.1:8000/user/ajax',
                dataType:'json',
                data:{'status':'desc'},
                success:function(data){
                    $product='';
                    for (let $i = 0; $i < data.length; $i++) {
                        // console.log(data[$i].name);
                       $product+=`
                       <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4" id="product">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{asset('storage/${data[$i].image}')}}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-eye"></i></a>
                                        </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${data[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${data[$i].price} kyats</h5>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                       `
                    }
                    $('#productContainer').html($product)
                }
            })
        }

    })
})

    </script>

@endsection
