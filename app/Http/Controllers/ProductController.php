<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //Product list page
    public function list(){
        $products=Product::select('products.*','categories.name as category_name')
        ->leftjoin('categories','products.category_id','categories.id')
        ->when(request('search_key'),function($search_product){
            $search_product->where('products.name','like','%'.request('search_key').'%');})
        ->orderBy('products.created_at','desc')->paginate(3);
        $products->append(request()->all());
        return view('admin.products.productList',compact('products'));
    }

    //product create page
    public function createPage(){
        $categories=Category::select('id','name')->get();
        return view('admin.products.productCreate',compact('categories'));
    }

    //product create function
    public function create(Request $req){
        // dd($req->toArray());
        $this->validationCheck($req,'create');
        $data=$this->getData($req);
        $fileName=uniqid().$req->file('image')->getClientOriginalName();
        $req->file('image')->storeAs('public',$fileName);
        $data['image']=$fileName;
        Product::create($data);
        return redirect()->route('admin#productList')->with(['createSuc'=>'Create Product Successful']);
    }

    //product detail function
    public function detail($id){
        $product=Product::select('products.*','categories.name as category_name')
        ->leftjoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.products.productDetail',compact('product'));
    }

    //product delete function
    public function delete($id){
        $productName=Product::where('id',$id)->first()->image;
        // dd($productName);
        $product=Product::where('id',$id)->delete();
        Storage::delete('public/'.$productName);
        return redirect()->route('admin#productList')->with(['deleteSuc'=>'Delete Product Successful']);
    }

    //product edit Page
    public function editPage($id){
        $product=Product::where('id',$id)->first();
        $categories=Category::select('id','name')->get();
        return view('admin.products.productEdit',compact(['product','categories']));
    }

    public function update(Request $req){
        // dd($req->toArray());
        $this->validationCheck($req,'update');
        $data=$this->getData($req);
        if ($req->hasFile('image')) {
            $dbName=Product::where('id',$req->id)->first()->image;

            Storage::delete('public/'.$dbName);
            $fileName=uniqid().$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;
        }
        Product::where('id',$req->id)->update($data);
        return redirect()->route('admin#productList')->with(['updateSuc'=>'Update Product Successful']);

    }


    //valitation check
    private function validationCheck($req,$status){
        $validationRule=[
            'name'=>'required|unique:products,name,'.$req->id,
            'category'=>'required',
            'description'=>'required',
            'price'=>'required',
            'durationTime'=>'required',
        ];
        if($status=='update'){
            $validationRule['image']='mimes:png,jpg,jpeg,webp';
        }else{
            $validationRule['image']='required|mimes:png,jpg,jpeg,webp';
        }

        Validator::make($req->all(),$validationRule)->validate();
    }

    private function getData($req){
        return [
            'name'=>$req->name,
            'category_id'=>$req->category,
            'description'=>$req->description,
            'price'=>$req->price,
            'duration_time'=>$req->durationTime

        ];
    }
}
