<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
   public function getAjax(Request $req){
    // logger($req->status);
    if ($req->status=='asc') {
        $data=Product::orderBy('created_at','asc')->get();
    } else{
        $data=Product::orderBy('created_at','desc')->get();
    }

    return $data;
   }

}
