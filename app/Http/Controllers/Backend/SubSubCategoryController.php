<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Models\SubCategory;
use App\Models\Category;

class SubSubCategoryController extends Controller
{
    public function SubSubCategoryView(){
        $categories = Category::OrderBy('category_name_en',"ASC")->get();
        $subsubcategory = SubSubCategory::latest()->get();
        return view("backend.category.subsubcategory_view",compact('subsubcategory','categories'));
    }
    public function GetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->OrderBy("subcategory_name_en",'ASC')->get();
         return json_encode($subcat);
    }
    public function GetSubSubCategory($subcategory_id){
        $subsubcat = SubSubCategory::where('subcategory_id',$subcategory_id)->OrderBy("subsubcategory_name_en",'ASC')->get();
         return json_encode($subsubcat);
    }

    public function SubSubCategoryStore(Request $request){
        $request->validate([
            'subsubcategory_name_en'=> 'required',
            'subsubcategory_name_ar'=> 'required',
            'category_id'=> 'required',
            'subcategory_id'=> 'required',
        ],[
            'subsubcategory_name_en.required'=> 'Input SubSubCategory English Name',
            'subsubcategory_name_ar.required'=> 'Input SubSubCategory Arabic Name',

        ]);


        SubSubCategory::insert([
            'subsubcategory_name_en'=>$request->subsubcategory_name_en,
            'subsubcategory_name_ar'=>$request->subsubcategory_name_ar,
            'subsubcategory_slug_en'=>strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_ar'=>str_replace(' ','-',$request->subsubcategory_name_ar),
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,

        ]);
        $notification = array(
            'message'=>'SubSubCategory Added Successfully',
            'alert-type'=>'success'
        );


        return redirect()->back()->with($notification);


    }
    public function SubSubCategoryEdit($id){
        $categories = Category::OrderBy('category_name_en',"ASC")->get();
        $subcategories = SubCategory::OrderBy('subcategory_name_en',"ASC")->get();
        $subsubcategory = SubSubCategory::findORfail($id);
        return view('backend.category.subsubcategory_edit',compact('subsubcategory','categories','subcategories'));
    }

    public function SubSubCategoryUpdate(Request $request,$id){

        $request->validate([
            'subsubcategory_name_en'=> 'required',
            'subsubcategory_name_ar'=> 'required',
            'category_id'=> 'required',
            'subcategory_id'=> 'required',
        ],[
            'subsubcategory_name_en.required'=> 'Input SubSubCategory English Name',
            'subsubcategory_name_ar.required'=> 'Input SubSubCategory Arabic Name',

        ]);

        $subsubcategory = SubSubCategory::find($id);

            SubSubCategory::find($id)->update([
                'subsubcategory_name_en'=>$request->subsubcategory_name_en,
                'subsubcategory_name_ar'=>$request->subsubcategory_name_ar,
                'subsubcategory_slug_en'=>strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
                'subsubcategory_slug_ar'=>str_replace(' ','-',$request->subsubcategory_name_ar),
                'category_id'=>$request->category_id,
                'subcategory_id'=>$request->subcategory_id,

            ]);
            $notification = array(
                'message'=>'SubSubCategory update Successfully',
                'alert-type'=>'success'
            );


            return redirect()->route('all.subsubcategory')->with($notification);
        }




    public function SubSubCategoryDelete($id){
        SubSubCategory::find($id)->delete();
        $notification = array(
            'message'=>'SubSubCategory Deleted Successfully',
            'alert-type'=>'info'
        );


        return redirect()->back()->with($notification);

    }
}
