<?php

namespace App\Http\Controllers\user;
use Storage;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home(){
        $id='';
        $products=Product::orderBy('created_at','desc')->get();
        $categories=Category::orderBy('created_at','desc')->get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $order=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('products','categories','id','cart','order'));
    }

    // account
    // profile page
    public function profile(){
        return view('user.account.profile');
    }

    //Edit profile page
    public function editProfilePage(){
        return view('user.account.editProfile');
    }

    //update profile
    public function updateProfile($id,Request $request){
        // dd($request->toArray());
        $this->profileValidation($request);
        $data=$this->getData($request);
        if ($request->hasFile('image')) {
            $dbName=User::where('id',$id)->first()->image;
            if ($dbName!=null) {
                Storage::delete('public/'.$dbName);
            }
            $fileName=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
            // dd($data);
        }
        User::where('id',$id)->update($data);
        return redirect()->route('user#profile')->with(['profileUpdate'=>'Profile update successful']);
    }

    //Change password page
    public function changePasswordPage(){
        return view('user.account.changePassword');
    }

    //change password function
    public function changePassword(Request $request){
        $this->validationCheck($request);
        $id=Auth::user()->id;
        $userPassword=User::select('password')->where('id',$id)->first()->password;
        $old_password=$request->oldPassword;
        $status=Hash::check($old_password, $userPassword);
        if($status){
            $new_password=Hash::make($request->newPassword);
            User::where('id',$id)->update([
                'password'=>$new_password,
            ]);

            return redirect()->route('user#changePasswordPage')
            ->with(['successPass'=>'Change password successful']);
        }
            return redirect()->route('user#changePasswordPage')
            ->with(['failPass'=>'Wrong Password. Try again later']);
    }

    // user category Group
        public function categoryGroup($id){
        if ($id!=0) {
            $products=Product::where('category_id',$id)->orderBy('created_at','desc')->get();
            $categories=Category::orderBy('created_at','desc')->get();
             $cart=Cart::where('user_id',Auth::user()->id)->get();
            $order=Order::where('user_id',Auth::user()->id)->get();
            return view('user.main.home',compact('products','categories','id','cart','order'));

        }else{
            $products=Product::orderBy('created_at','desc')->get();
            $categories=Category::orderBy('created_at','desc')->get();
             $cart=Cart::where('user_id',Auth::user()->id)->get();
            $order=Order::where('user_id',Auth::user()->id)->get();
            return view('user.main.home',compact('products','categories','id','cart','order'));

        }
        }

    //product detail page
    public function productDetail($id){
        $product=Product::where('id',$id)->first();
        $products=Product::get();
        // dd('storage/'.$product->image);
        return view('user.main.detail',compact('product','products'));
    }

    // view count increase
    public function viewCountIncrease(Request $req){
        $product=Product::where('id',$req->productId)->first();
        $viewCount=$product->view_count +1;
        $data=[
            'view_count'=>$viewCount,
        ];
        Product::where('id',$req->productId)->update($data);

        $data=[
            'message'=>'success'
        ];
       return response()->json($data, 200);
    }


     //Check password validation
     private function validationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:4|max:16',
            'newPassword'=>'required|min:4|max:16',
            'comfirmPassword'=>'required|min:4|max:16|same:newPassword',
        ])->validate();
    }

    //Check profile validation
    private function profileValidation($request){
        Validator::make($request->all(),[
            'name'=>'required|unique:users,name,'.Auth::user()->id,
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'gender'=>'required',
            'image'=>'mimes:png,jpg,jpeg,wepb'
        ])->validate();
    }

    private function getData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'gender'=>$request->gender,

        ];
    }
}
