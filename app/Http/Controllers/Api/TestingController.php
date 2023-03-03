<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestingController extends Controller
{
    // get product with api
    public function product(){
        $product=Product::get();
        return response()->json($product, 200);
    }

    //get detail with api
    public function detail(){
        $products=Product::get();
        $categories=Category::get();
        $users=User::get();
        $contact=Contact::get();

        $detail=[
            'user'=>$users,
            'categories'=>$categories,
            'products'=>$products,
            'contacts'=>$contact,
        ];
        return response()->json($detail, 200);
    }

    //read category
    public function readCategory(){
        $categories=Category::get();
        return response()->json($categories, 200);
    }

    //read category with id

    public function readCategoryID($id){
        $category=Category::where('id',$id)->first();
        if (isset($category)) {
           return response()->json($category, 200);
        }

        return response()->json(['message'=>'There is no category'], 404);
    }

    // update category

    public function updateCategory(Request $req){

    $category=Category::where('id',$req->category_id)->first();
    if (isset($category)) {
        $data=[
            'name'=>$req->category_name,
          ];
        Category::where('id',$req->category_id)->update($data);
        $category=Category::where('id',$req->category_id)->first();
        $data=[
            'category'=>$category,
            'message'=>'Updatevsuccessful',
        ];
          return response()->json($data, 200);

    }
    return response()->json(['message'=>'There is no category'], 404);

    }

    // create category

    public function createCategory(Request $req){

        $data=[
            'name'=>$req->name
        ];
        Category::create($data);
        $category=Category::orderBy('id','desc')->get();
        return response()->json($category, 200);

    }

    // delete category
    public function deleteCategory($id){
        $category=Category::where('id',$id)->first();

        if (isset($category)) {
            $data=[
                'category'=>$category,
                'message'=>'delete successful',
            ];
            Category::where('id',$id)->delete();
            return response()->json($data, 200);
        }

        return response()->json(['message'=>'There is no category'], 404);
    }
}
