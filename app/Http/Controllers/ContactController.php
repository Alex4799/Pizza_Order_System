<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //user
    //contactPage
    public function contactPage(){
        return view('user.main.contact');
    }

    //contact send
    public function send(Request $req){
        $data=[
            'name'=>$req->name,
            'email'=>$req->email,
            'message'=>$req->message,
        ];
        Contact::create($data);
        return redirect()->route('user#contactPage')->with(['success'=>'Email send successful.We will contact soon....']);
    }

    //admin
    //contact list
    public function listPage(){
        $contacts=Contact::get();
        return view('admin.contact.list',compact('contacts'));
    }

    // info
    public function info($id){

        $contact=Contact::where('id',$id)->first();
        Contact::where('id',$id)->update(['status'=>1]);
        return view('admin.contact.info',compact('contact'));
    }
}
