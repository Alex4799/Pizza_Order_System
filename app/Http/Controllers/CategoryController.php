<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct to list page
    public function list(){
        // dd();
        $categoryList=Category::when(request('search_key'),function($search_category){
            $search_category->where('name','like','%'.request('search_key').'%');
        })->orderBy('created_at','desc')->paginate(3);
        $categoryList->append(request()->all());

        $contact=Contact::where('status',0)->get();
        return view('admin.category.list',compact('categoryList','contact'));
    }

    //direct to creat Page
    public function createPage(){
        return view('admin.category.create');
    }

    //create category
    public function create(Request $request){
        // dd($request->toArray());
        $this->validation($request);
        $data=$this->getDate($request);
        // dd($data);
        Category::create($data);
        return redirect()->route('category#list')->with(['createSuc'=>'Create Success']);
    }

    //delete category
    public function delete($id){
        Category::where('id',$id)->delete();
        return redirect()->route('category#list')->with(['deleteSuc'=>'Delete Success']);

    }
    //direct to Edit Page
    public function editPage($id){
        $category_item=Category::where('id',$id)->first();
        // dd($category_item->toArray());
        return view('admin.category.edit',compact('category_item'));
    }

    //update function
    public function update(Request $request){
        // dd($request->toArray());
        $this->validation($request);
        $data=$this->getDate($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list');

    }

    // validationCheck
    private function validation($request){

        Validator::make($request->all(),[
            'categoryName'=>'required|unique:categories,name,'. $request->categoryId,
           ])->validate();
    }

    //created data
    private function getDate($request){
        return [
            'name'=>$request->categoryName,
        ];
    }
}
