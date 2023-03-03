<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //password
    //Direct Change Password Page
    public function changePasswordPage(){
        return view('admin.account.passwordChange');

    }

    //Change password function
    public function changePassword(Request $request){
        // 1. all field must be fill
        // 2. new password and confirm password length must be greater than 8
        // 3. new password and confirm password must be same
        // 4. old password and db password must be same
        // 5. password same

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

            return redirect()->route('admin#changePasswordPage')
            ->with(['successPass'=>'Change password successful']);
        }
            return redirect()->route('admin#changePasswordPage')
                ->with(['failPass'=>'Wrong Password. Try again later']);
    }

    //Profile Page
    public function profile(){
        return view('admin.account.profile');
    }

    //Profile edit page
    public function editPage(){
        return view('admin.account.editProfile');
    }

    //Profile update function
    public function update($id,Request $request){
        // dd($request->image);
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
        return redirect()->route('admin#profile')->with(['profileUpdate'=>'Profile update successful']);
    }

    //Admin list page
    public function list(){
        $adminList=User::when(request('search_key'),function($key){
            $key->orWhere('name','like','%'.request('search_key').'%')
                ->orWhere('email','like','%'.request('search_key').'%')
                ->orWhere('phone','like','%'.request('search_key').'%')
                ->orWhere('address','like','%'.request('search_key').'%');
        })
        ->where('role','admin')->paginate(3);
        $adminList->append(request()->all());
        return view('admin.account.list',compact('adminList'));
    }

    //admin list delete
    public function delete($id){
        // dd($id);
        User::where('id',$id)->delete();
        return redirect()->route('admin#list')->with(['deleteSucc'=>'Admin account delete successful']);
    }

    //change role Page
    public function changeRolePage($id){
        $data=User::where('id',$id)->first();

        return view('admin.account.changeRole',compact('data'));
    }

    public function changeRole(Request $req){
        $changeRole=[
            'role'=>$req->changeRole,
        ];
        User::where('id',$req->adminId)->update($changeRole);
        $success=[
            'message'=>'Change Role Complete',
        ];
        return response()->json($success, 200);
    }

    // admin User List Page
    public function adminUserList(){
        $userList=User::when(request('search_key'),function($key){
            $key->orWhere('name','like','%'.request('search_key').'%')
                ->orWhere('email','like','%'.request('search_key').'%')
                ->orWhere('phone','like','%'.request('search_key').'%')
                ->orWhere('address','like','%'.request('search_key').'%');
        })
        ->where('role','user')->paginate(3);
        $userList->append(request()->all());
        return view('admin.user.userList',compact('userList'));
    }

    //user Change Role
    public function userChangeRole(Request $req){
        $changeRole=[
            'role'=>$req->changeRole,
        ];
        User::where('id',$req->userId)->update($changeRole);
        $success=[
            'message'=>'Change Role Complete',
        ];
        return response()->json($success, 200);
    }

    // user account delete
    public function userAccountDelete($id){

        $user=User::where('id',$id)->first();
            $dbName=$user->image;
            if ($dbName!=null) {
                Storage::delete('public/'.$dbName);
            }

        User::where('id',$id)->delete();

            return back();
    }

    //get change role data

    private function getRole($req){

        return [
            'role'=>$req->role
        ];
    }
    //check profile validation

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

    //Check password validation
    private function validationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:4|max:16',
            'newPassword'=>'required|min:4|max:16',
            'comfirmPassword'=>'required|min:4|max:16|same:newPassword',
        ])->validate();
    }

}
