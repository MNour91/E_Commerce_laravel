<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\BlogPost;
use App\Models\SubCategory;
use App\Models\SubSubCategory;


class IndexController extends Controller
{

   public function index(){
      $slider = Slider::where('status',1)->orderBy('id',"DESC")->limit(3)->get();

      $categories = Category::orderBy('category_name_en',"ASC")->get();

      $blogpost = BlogPost::latest()->get();

      $products = Product::where('status',1)->orderBy('id',"DESC")->limit(5)->get();

      $featured = Product::where('featured',1)->where('status',1)->orderBy('id',"DESC")->limit(5)->get();



      $special_offer = Product::where('special_offer',1)->where('status',1)->orderBy('id',"DESC")->limit(5)->get();

      $special_deals = Product::where('special_deals',1)->where('status',1)->orderBy('id',"DESC")->limit(5)->get();

      $skip_category_0 =Category::skip(0)->first(); //for send id first row in category table

      $skip_products_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id',"DESC")->limit(6)->get();

      $skip_brand_0 =Brand::skip(0)->first(); //for send id first row in category table

      $skip_products_brand_0 = Product::where('status',1)->where('brand_id',$skip_brand_0->id)->orderBy('id',"DESC")->limit(6)->get();



       return view('frontend.index',compact('categories','slider','products','featured','special_offer','special_deals','skip_category_0','skip_products_0','skip_products_brand_0','skip_brand_0','blogpost'));

   }
   public function UserLogout(){
     Auth::logout();
     return redirect()->route('login');
   }
   public function UserProfile(){
    $id =Auth::user()->id;
    $user =User::find($id);
    return view('frontend.profile.user_profile',compact('user'));
   }
   public function UserProfileStore(Request $request){
    $id =Auth::user()->id;
    $data =User::find($id);
    $data->name = $request->name;
    $data->email = $request->email;
    $data->phone = $request->phone;
    if($request->file('profile_photo_path')){
        $file = $request->file('profile_photo_path');
        @unlink(public_path('upload/user_images'),$data->profile_photo_path);
        $filename = date('YmdHi').".".$file->getClientOriginalExtension();
        $file->move(public_path('upload/user_images'),$filename);
        $data['profile_photo_path'] = $filename;
    }
    $data->save();
    $notification = array(
        'message'=> 'User Profile Updated Successfully',
        'alert-type'=>'success'
    );

    return redirect()->route('dashboard')->with($notification);
   }

   public function UserChangePassword(){
    return view('frontend.profile.user_change_password');
    }

    public function UserPasswordUpdate(Request $request){
        $id =Auth::user()->id;
        $validateData = $request->validate([
            'oldpassword'=>'required',
            'password'=>'required|confirmed',
        ]);
        $HashedPassword =User::find($id)->password;

        if(Hash::check($request->oldpassword, $HashedPassword)){
            $user=User::find($id);
            $user->password = Hash::make($request->password);
            $user->save();
            $notification = array(
                'message'=>' User Change Password Successfully',
                'alert-type'=>'success'
            );

            return redirect()->route('user.logout')->with($notification);
        }else{
            $notification = array(
                'message'=>'Current Password is Wrong',
                'alert-type'=>'warning'
            );

            return redirect()->back()->with($notification);
        }
    }


    public function ProductDetails($id,$slug){
        $product = Product::findOrFail($id);
        $color_en = $product->product_color_en;
		$product_color_en = explode(',', $color_en);

		$color_ar = $product->product_color_ar;
		$product_color_ar = explode(',', $color_ar);

		$size_en = $product->product_size_en;
		$product_size_en = explode(',', $size_en);

		$size_ar = $product->product_size_ar;
		$product_size_ar = explode(',', $size_ar);
        $multi = MultiImg::where('product_id',$id)->get();

        $cat_id = $product->category_id;
        $relatedproduct= Product::where('category_id',$cat_id)->where('id','!=',$id)->orderby('id','DESC')->get();



        return view('frontend.pages.Product_details',compact('product','multi','product_color_en','product_color_ar','product_size_en','product_size_ar','relatedproduct'));
    }

    public function TagWiseProductAR($tag){
        $products = Product::where('status',1)->where('product_tags_ar',$tag)->orderBy('id','DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en',"ASC")->get();
        return view('frontend.tags.tags_view',compact('products','categories'));

    }
    public function TagWiseProductEN($tag){
        $products = Product::where('status',1)->where('product_tags_en',$tag)->orderBy('id','DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en',"ASC")->get();
        return view('frontend.tags.tags_view',compact('products','categories'));

    }

    public function SubWiseProduct($id,$slug){
        $products = Product::where('status',1)->where('subcategory_id',$id)->orderBy('id','DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en',"ASC")->get();
        $breadsubcat = SubCategory::with(['category'])->where('id',$subcat_id)->get();
        return view('frontend.pages.subcategory_product',compact('products','categories','breadsubcat'));

    }
    public function SubSubWiseProduct($id,$slug){
        $products = Product::where('status',1)->where('subsubcategory_id',$id)->orderBy('id','DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en',"ASC")->get();
        $breadsubsubcat = SubSubCategory::with(['category','subcategory'])->where('id',$subsubcat_id)->get();
        return view('frontend.pages.subsubcategory_product',compact('products','categories','breadsubsubcat'));

    }

    //product view with ajax
    public function productViewAjax($id){
        $product = Product::with('category','brand')->findOrFail($id);
        $color = $product->product_color_en;
		$product_color = explode(',', $color);


		$size = $product->product_size_en;
		$product_size = explode(',', $size);
        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ));

    } // end method


    // Product Search
	public function ProductSearch(Request $request){
        	$request->validate(["search" => "required"]);
		$item = $request->search;
		// echo "$item";
        $categories = Category::orderBy('category_name_en','ASC')->get();
		$products = Product::where('product_name_en','LIKE',"%$item%")->get();
		return view('frontend.pages.search',compact('products','categories'));


	}// end meth

    ///// Advance Search Options

	public function SearchProduct(Request $request){
		$request->validate(["search" => "required"]);

		$item = $request->search;		 

		$products = Product::where('product_name_en','LIKE',"%$item%")->select('product_name_en','product_thambnail','selling_price','id','product_slug_en')->limit(5)->get();
		return view('frontend.product.search_product',compact('products'));




	} // end method











}


