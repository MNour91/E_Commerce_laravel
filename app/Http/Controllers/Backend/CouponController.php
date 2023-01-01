<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;


class CouponController extends Controller
{
    public function CouponView(){
    	$coupons = Coupon::orderBy('id','DESC')->get();
    	return view('backend.coupon.view_coupon',compact('coupons'));

    }

    public function CouponStore(Request $request){

        $request->validate([
            'coupon_name'=> 'required',
            'coupon_discount'=> 'required',
            'coupon_validity'=> 'required',
        ],[
            'coupon_name.required'=> 'Input Coupon Name',
            'coupon_discount.required'=> 'Input Coupon Discount ',

        ]);


        Coupon::insert([
            'coupon_name'=>strtoupper($request->coupon_name),
            'coupon_discount'=>$request->coupon_discount,
            'coupon_validity'=>$request->coupon_validity,
            'created_at'=>Carbon::now(),

        ]);
        $notification = array(
            'message'=>'Coupon Added Successfully',

            'alert-type'=>'success'
        );


        return redirect()->back()->with($notification);

    }

    public function CouponEdit($id){
        $coupon = Coupon::findORfail($id);
        return view('backend.coupon.edit_coupon',compact('coupon'));
    }

    public function CouponUpdate(Request $request,$id){
        $request->validate([
            'coupon_name'=> 'required',
            'coupon_discount'=> 'required',
            'coupon_validity'=> 'required',
        ],[
            'coupon_name.required'=> 'Input Coupon Name',
            'coupon_discount.required'=> 'Input Coupon Discount ',

        ]);


        
   
        Coupon::findOrFail($id)->update([
                'coupon_name'=>strtoupper($request->coupon_name),
                'coupon_discount'=>$request->coupon_discount,
                'coupon_validity'=>$request->coupon_validity,
                

            ]);
            $notification = array(
                'message'=>'Coupon updated Successfully',
                'alert-type'=>'info'
            );


            return redirect()->route('manage-coupon')->with($notification);
        }

  


    public function CouponDelete($id){
        Coupon::findOrFail($id)->delete();
        $notification = array(
            'message'=>'Coupon Deleted Successfully',
            'alert-type'=>'info'
        );


        return redirect()->back()->with($notification);

    }

}
