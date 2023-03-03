<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //user
    // add cart function
    public function addCart(Request $req){
        $data=$this->changeArray($req);
        Cart::create($data);
        $response=[
            'status'=>'success',
            'message'=>'Add to cart successful'
        ];
        return response()->json($response, 200);
       }

        //cart page
        public function cartPage(){
            $cart=Cart::select('carts.*','products.name as product_name','products.price as product_price','products.image as image')
            ->leftJoin('products','products.id','carts.product_id')
            ->where('user_id',Auth::user()->id)->get();
            $total=0;
            foreach ($cart as $c) {
                $total+= $c->product_price*$c->qty;
            }
            return view('user.cart.cartPage',compact('cart','total'));
        }

        //remove
        public function remove(Request $req){
            logger($req->cartId);
            Cart::where('id',$req->cartId)->delete();
        }

        public function removeAll(){
            Cart::where('user_id',Auth::user()->id)->delete();
        }



       private function changeArray($req){
            return [
                'user_id'=>$req->userId,
                'product_id'=>$req->productId,
                'qty'=>$req->count,
            ];
       }


}
