<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function SubCategoryView(){
        $categories = Category::OrderBy('category_name_en',"ASC")->get();
        $subcategory = SubCategory::latest()->get();
        return view("backend.category.subcategory_view",compact('subcategory','categories'));
    }

    public function SubCategoryStore(Request $request){
        $request->validate([
            'subcategory_name_en'=> 'required',
            'subcategory_name_ar'=> 'required',
            'category_id'=> 'required',
        ],[
            'subcategory_name_en.required'=> 'Input SubCategory English Name',
            'subcategory_name_ar.required'=> 'Input SubCategory Arabic Name',

        ]);

    
        SubCategory::insert([
            'subcategory_name_en'=>$request->subcategory_name_en,
            'subcategory_name_ar'=>$request->subcategory_name_ar,
            'subcategory_slug_en'=>strtolower(str_replace(' ','-',$request->subcategory_name_en)),
            'subcategory_slug_ar'=>str_replace(' ','-',$request->subcategory_name_ar),
            'category_id'=>$request->category_id,

        ]);
        $notification = array(
            'message'=>'SubCategory Added Successfully',
            'alert-type'=>'success'
        );


        return redirect()->back()->with($notification);


    }
    public function SubCategoryEdit($id){
        $categories = Category::OrderBy('category_name_en',"ASC")->get();
        $subcategory = SubCategory::findORfail($id);
        return view('backend.category.subcategory_edit',compact('subcategory','categories'));
    }

    public function SubCategoryUpdate(Request $request,$id){

        $request->validate([
            'subcategory_name_en'=> 'required',
            'subcategory_name_ar'=> 'required',
            'category_id'=> 'required',
        ],[
            'subcategory_name_en.required'=> 'Input SubCategory English Name',
            'subcategory_name_ar.required'=> 'Input SubCategory Arabic Name',

        ]);

        $subcategory = SubCategory::find($id);
   
            SubCategory::find($id)->update([
                'subcategory_name_en'=>$request->subcategory_name_en,
                'subcategory_name_ar'=>$request->subcategory_name_ar,
                'subcategory_slug_en'=>strtolower(str_replace(' ','-',$request->subcategory_name_en)),
                'subcategory_slug_ar'=>str_replace(' ','-',$request->subcategory_name_ar),
                'category_id'=>$request->category_id,

            ]);
            $notification = array(
                'message'=>'SubCategory update Successfully',
                'alert-type'=>'success'
            );


            return redirect()->route('all.subcategory')->with($notification);
        }

  


    public function SubCategoryDelete($id){
        SubCategory::find($id)->delete();
        $notification = array(
            'message'=>'SubCategory Deleted Successfully',
            'alert-type'=>'info'
        );


        return redirect()->back()->with($notification);

    }
}
