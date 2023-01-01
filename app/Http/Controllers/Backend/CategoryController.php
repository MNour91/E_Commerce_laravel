<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;
use Auth;
class CategoryController extends Controller

{
    // public function __construct(){
    //     $this->middleware('auth');
    // }
    public function CategoryView(){
        $category = Category::latest()->get();
        return view("backend.category.category_view",compact('category'));
    }
    public function CategoryStore(Request $request){
        $request->validate([
            'category_name_en'=> 'required',
            'category_name_ar'=> 'required',
            'category_icon'=> 'required',
        ],[
            'category_name_en.required'=> 'Input Category English Name',
            'category_name_ar.required'=> 'Input Category Arabic Name',

        ]);

    
        Category::insert([
            'category_name_en'=>$request->category_name_en,
            'category_name_ar'=>$request->category_name_ar,
            'category_slug_en'=>strtolower(str_replace(' ','-',$request->category_name_en)),
            'category_slug_ar'=>str_replace(' ','-',$request->category_name_ar),
            'category_icon'=>$request->category_icon,

        ]);
        $notification = array(
            'message'=>'Category Added Successfully',
            'alert-type'=>'success'
        );


        return redirect()->back()->with($notification);


    }
    public function CategoryEdit($id){
        $category = Category::findORfail($id);
        return view('backend.category.category_edit',compact('category'));
    }

    public function CategoryUpdate(Request $request,$id){
        $request->validate([
            'category_name_en'=> 'required',
            'category_name_ar'=> 'required',
            'category_icon'=> 'required',
        ],[
            'category_name_en.required'=> 'Input Category English Name',
            'category_name_ar.required'=> 'Input Category Arabic Name',

        ]);

        $category = Category::find($id);
   
            Category::find($id)->update([
                'category_name_en'=>$request->category_name_en,
                'category_name_ar'=>$request->category_name_ar,
                'category_slug_en'=>strtolower(str_replace(' ','-',$request->category_name_en)),
                'category_slug_ar'=>str_replace(' ','-',$request->category_name_ar),
                'category_icon'=>$request->category_icon,

            ]);
            $notification = array(
                'message'=>'Category update Successfully',
                'alert-type'=>'success'
            );


            return redirect()->route('all.category')->with($notification);
        }

  


    public function CategoryDelete($id){
        Category::find($id)->delete();
        $notification = array(
            'message'=>'Category Deleted Successfully',
            'alert-type'=>'info'
        );


        return redirect()->back()->with($notification);

    }

}
