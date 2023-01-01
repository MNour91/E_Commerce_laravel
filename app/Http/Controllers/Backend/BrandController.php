<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;
use Auth;
class BrandController extends Controller
{
    // public function __construct(){
    //     $this->middleware('admin');
    // }
    public function BrandView(){
        $brand = Brand::latest()->get();
        return view("backend.brand.brand_view",compact('brand'));
    }
    public function BrandStore(Request $request){
        $request->validate([
            'brand_name_en'=> 'required',
            'brand_name_ar'=> 'required',
            'brand_image'=> 'required',
        ],[
            'brand_name_en.required'=> 'Input Brand English Name',
            'brand_name_ar.required'=> 'Input Brand Arabic Name',

        ]);

        $image = $request->file('brand_image');
        $name_gan = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gan);
        $save_url = 'upload/brand/'.$name_gan;
        Brand::insert([
            'brand_name_en'=>$request->brand_name_en,
            'brand_name_ar'=>$request->brand_name_ar,
            'brand_slug_en'=>strtolower(str_replace(' ','-',$request->brand_name_en)),
            'brand_slug_ar'=>str_replace(' ','-',$request->brand_name_ar),
            'brand_image'=>$save_url,

        ]);
        $notification = array(
            'message'=>'Brand Added Successfully',
            'alert-type'=>'success'
        );


        return redirect()->back()->with($notification);


    }
    public function BrandEdit($id){
        $brand = Brand::findORfail($id);
        return view('backend.brand.brand_edit',compact('brand'));
    }

    public function BrandUpdate(Request $request,$id){
        $request->validate([
            'brand_name_en'=> 'required',
            'brand_name_ar'=> 'required',

        ],[
            'brand_name_en.required'=> 'Input Brand English Name',
            'brand_name_ar.required'=> 'Input Brand Arabic Name',

        ]);

        $brand = Brand::find($id);
        if($request->file('brand_image')){
            $image = $request->file("brand_image");
            @unlink(public_path($brand->brand_image));
            $name_gan = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gan);
            $save_url = 'upload/brand/'.$name_gan;
            Brand::find($id)->update([
                'brand_name_en'=>$request->brand_name_en,
                'brand_name_ar'=>$request->brand_name_ar,
                'brand_slug_en'=>strtolower(str_replace(' ','-',$request->brand_name_en)),
                'brand_slug_ar'=>str_replace(' ','-',$request->brand_name_ar),
                'brand_image'=>$save_url,

            ]);
            $notification = array(
                'message'=>'Brand update Successfully',
                'alert-type'=>'success'
            );


            return redirect()->route('all.brand')->with($notification);
        }else{
            Brand::find($id)->update([
                'brand_name_en'=>$request->brand_name_en,
                'brand_name_ar'=>$request->brand_name_ar,
                'brand_slug_en'=>strtolower(str_replace(' ','-',$request->brand_name_en)),
                'brand_slug_ar'=>str_replace(' ','-',$request->brand_name_ar),


            ]);
            $notification = array(
                'message'=>'Brand update Successfully',
                'alert-type'=>'success'
            );


            return redirect()->route('all.brand')->with($notification);
        }

    }


    public function BrandDelete($id){
        $brand = Brand::find($id);
        $img = $brand->brand_image;
        @unlink(public_path($img));

        Brand::find($id)->delete();
        $notification = array(
            'message'=>'Brand Deleted Successfully',
            'alert-type'=>'info'
        );


        return redirect()->back()->with($notification);

    }





}
