<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\MultiImg;
use Carbon\Carbon;
use Image;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function AddProduct(){
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.product_add',compact('categories','brands'));

    }
    public function ProductStore(Request $request){

        $image = $request->file('product_thambnail');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
    	$save_url = 'upload/products/thambnail/'.$name_gen;

     $product_id = Product::insertGetId([
      	'brand_id' => $request->brand_id,
      	'category_id' => $request->category_id,
      	'subcategory_id' => $request->subcategory_id,
      	'subsubcategory_id' => $request->subsubcategory_id,
      	'product_name_en' => $request->product_name_en,
      	'product_name_ar' => $request->product_name_ar,
      	'product_slug_en' =>  strtolower(str_replace(' ', '-', $request->product_name_en)),
      	'product_slug_ar' => str_replace(' ', '-', $request->product_name_ar),
      	'product_code' => $request->product_code,

      	'product_qty' => $request->product_qty,
      	'product_tags_en' => $request->product_tags_en,
      	'product_tags_ar' => $request->product_tags_ar,
      	'product_size_en' => $request->product_size_en,
      	'product_size_ar' => $request->product_size_ar,
      	'product_color_en' => $request->product_color_en,
      	'product_color_ar' => $request->product_color_ar,

      	'selling_price' => $request->selling_price,
      	'discount_price' => $request->discount_price,
      	'short_descp_en' => $request->short_descp_en,
      	'short_descp_ar' => $request->short_descp_ar,
      	'long_descp_en' => $request->long_descp_en,
      	'long_descp_ar' => $request->long_descp_ar,

      	'hot_deals' => $request->hot_deals,
      	'featured' => $request->featured,
      	'special_offer' => $request->special_offer,
      	'special_deals' => $request->special_deals,

      	'product_thambnail' => $save_url,
      	'status' => 1,
      	'created_at' => Carbon::now(),

      ]);
      /////////////////////////// Multi Image Upload start ////////
        $images = $request->file('multi_img');
        foreach($images  as $img){
            $make_neme_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('upload/products/multi/'.$make_neme_gen);
            $upload_images = 'upload/products/multi/'.$make_neme_gen;

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $upload_images,
                'created_at' => Carbon::now(),
            ]);
        }
       /////////////////////////// Multi Image Upload end ////////
       $notification = array(
        'message'=>'Product Inserted Successfully',
        'alert-type'=>'success'
    );


    return redirect()->route('manage-product')->with($notification);

    }//end Method

    public function ProductView(){
        $products = Product::latest()->get();
        return view('backend.product.product_view',compact('products'));
    }


    public function ProductEdit($id){
        $multiImgs = MultiImg::where('product_id',$id)->get();
        $categories = Category::latest()->get();
        $brand = Brand::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('backend.product.product_edit',compact('products','categories','brand','subcategories','subsubcategories','multiImgs'));
    }

    public function ProductUpdate(Request $request,$id){

         Product::findOrFail($id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_ar' => $request->product_name_ar,
            'product_slug_en' =>  strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_ar' => str_replace(' ', '-', $request->product_name_ar),
            'product_code' => $request->product_code,

            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_ar' => $request->product_tags_ar,
            'product_size_en' => $request->product_size_en,
            'product_size_ar' => $request->product_size_ar,
            'product_color_en' => $request->product_color_en,
            'product_color_ar' => $request->product_color_ar,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_ar' => $request->short_descp_ar,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_ar' => $request->long_descp_ar,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,


            'status' => 1,
            'updated_at' => Carbon::now(),

        ]);

        $notification = array(
            'message'=>'Product Update withouut Image Successfully',
            'alert-type'=>'info'
        );


        return redirect()->route('manage-product')->with($notification);
    }

    // Multiple Image Update
	public function MultiImageUpdate(Request $request){
		$imgs = $request->multi_img;

		foreach ($imgs as $id => $img) {
	    $imgDel = MultiImg::findOrFail($id);
	    unlink($imgDel->photo_name);

    	$make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
    	Image::make($img)->resize(917,1000)->save('upload/products/multi/'.$make_name);
    	$uploadPath = 'upload/products/multi/'.$make_name;

    	MultiImg::where('id',$id)->update([
    		'photo_name' => $uploadPath,
    		'updated_at' => Carbon::now(),

    	]);

	 } // end foreach

       $notification = array(
			'message' => 'Product Image Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('manage-product')->with($notification);

	} // end mehtod




    public function ThmbUpdate(Request $request ,$id){
        $old_img= $request->old_img;
        unlink($old_img);
        $image = $request->file('product_thambnail');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
    	$save_url = 'upload/products/thambnail/'.$name_gen;
        Product::findOrFail($id)->update([
            'product_thambnail'=>$save_url,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
			'message' => 'Product thambnail Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('manage-product')->with($notification);

    }//end mathod

    public function DeleteMultiImg($id){
        $imgDel = MultiImg::findOrFail($id);
        unlink($imgDel->photo_name);
        MultiImg::findOrFail($id)->delete();
        $notification = array(
			'message' => 'Product Image Deleted Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    }//end mathod

    public function ProductInactive($id){

        Product::findOrFail($id)->update([
            'status'=> 0 ,

        ]);
        $notification = array(
			'message' => 'Product InActive Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    }//end mathod

    public function ProductActive($id){

        Product::findOrFail($id)->update([
            'status'=> 1 ,

        ]);
        $notification = array(
			'message' => 'Product Active Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    }//end mathod

    public function ProductDelete($id){
        $product =Product::findOrFail($id);

        unlink($product->product_thambnail);
        Product::findOrFail($id)->delete();
        $images = MultiImg::where("product_id",$id)->get();
        foreach($images as $img){
            unlink($img->photo_name);
            MultiImg::where("product_id",$id)->delete();
        }
        $notification = array(
			'message' => 'Product Deleted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    }//end mathod


    // product Stock 
    public function ProductStock(){

        $products = Product::latest()->get();
        return view('backend.product.product_stock',compact('products'));
    }








}
