<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // user
    // order list
    public function list(Request $req){
        $totalPrice=3000;
        foreach ($req->all() as $item){
            $data=OrderList::create([
                'user_id'=>$item['user_id'],
                'product_id'=>$item['product_id'],
                'qty'=>$item['qty'],
                'total'=>$item['total'],
                'orderCode'=>$item['orderCode'],
            ]);

            $totalPrice+=$item['total'];
        };
        Cart::where('user_id',Auth::user()->id)->delete();
        Order::create([
            'user_id'=>Auth::user()->id,
            'orderCode'=>$data->orderCode,
            'total_price'=>$totalPrice,
        ]);

        return response()->json([
            'status'=>'true',
            'message'=>'Order Complete'
        ], 200);
    }

    //order history page

    public function historyPage(){
        $order=Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('user.main.orderHistory',compact('order'));
    }

    //admin

    //oder list
    public function adminOrderList(){
        $order=Order::select('orders.*','users.name as user_name')
            ->leftJoin('users','users.id','orders.user_id')
            ->when(request('search_key'),function($search_order){
                $search_order->orWhere('users.name','like','%'.request('search_key').'%')->orWhere('orders.orderCode','like','%'.request('search_key').'%');
            })->get();
            $status='all';

        return view('admin.order.orderList',compact('order','status'));
    }

    //order status

    public function orderStatus($status){

        $order=Order::select('orders.*','users.name as user_name')
            ->leftJoin('users','users.id','orders.user_id')
            ->when(request('search_key'),function($search_order){
                $search_order->orWhere('users.name','like','%'.request('search_key').'%')->orWhere('orders.orderCode','like','%'.request('search_key').'%');
            });
        if ($status=='all') {
            $order=$order->get();
        }else{
            $order=$order->where('orders.status',$status)->get();
        }
        return view('admin.order.orderList',compact('order','status'));
    }

    //change order status

    public function orderChangeStatus(Request $req){
        Order::where('id',$req->order_id)->update([
            'status'=>$req->changeStatus,
        ]);
    }

    //Order list info page

    public function listInfo($orderCode){
        $orderList=OrderList::select('order_lists.*','users.name as user_name','products.name as product_name','products.image as product_image')
        ->leftJoin('users','users.id','order_lists.user_id')
        ->leftJoin('products','products.id','product_id')
        ->where('orderCode',$orderCode)->get();
        $order=Order::where('orderCode',$orderCode)->first();
        return view('admin.order.listInfo',compact('orderList','order'));
    }
}
