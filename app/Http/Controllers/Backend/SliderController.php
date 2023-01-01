<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Carbon\Carbon;
use Image;

class SliderController extends Controller
{
    public function SliderView(){
        $slider = Slider::latest()->get();
        return view("backend.slider.slider_view",compact('slider'));
    }
    public function SliderStore(Request $request){
        $request->validate([
           
            'slider_img'=> 'required',
        ],[
            'slider_img.required'=> 'Input Slider Image',
            

        ]);

        $image = $request->file('slider_img');
        $name_gan = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(870,370)->save('upload/slider/'.$name_gan);
        $save_url = 'upload/slider/'.$name_gan;
        Slider::insert([
                'title'=>$request->title,
                'description'=>$request->description,
                'slider_img'=>$save_url,
                'status' => 1,
                'created_at' => Carbon::now(),
      

        ]);
        $notification = array(
            'message'=>'Slider Added Successfully',
            'alert-type'=>'success'
        );


        return redirect()->back()->with($notification);


    }
    public function SliderEdit($id){
        $slider = Slider::findORfail($id);
        return view('backend.slider.slider_edit',compact('slider'));
    }

    public function SliderUpdate(Request $request,$id){
        $request->validate([
            'slider_img'=> 'required',
           

        ],[
            'slider_img.required'=> 'Input Slider Image',
        

        ]);

        $slider = Slider::find($id);
        if($request->file('slider_img')){
            $image = $request->file("slider_img");
            @unlink(public_path($slider->slider_img));
            $name_gan = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(870,370)->save('upload/slider/'.$name_gan);
            $save_url = 'upload/slider/'.$name_gan;
            Slider::find($id)->update([
                'title'=>$request->title,
                'description'=>$request->description,
                'slider_img'=>$save_url,
                'update_at' => Carbon::now(),

            ]);
            $notification = array(
                'message'=>'Slider update Successfully',
                'alert-type'=>'success'
            );


            return redirect()->route('all.slider')->with($notification);
        }else{
            Slider::find($id)->update([
                'title'=>$request->title,
                'description'=>$request->description,
               


            ]);
            $notification = array(
                'message'=>'Slider update Successfully',
                'alert-type'=>'success'
            );


            return redirect()->route('manage-slider')->with($notification);
        }

    }


    public function SliderDelete($id){
        $slider = Slider::find($id);
        $img = $slider->slider_img;
        @unlink(public_path($img));

        Slider::find($id)->delete();
        $notification = array(
            'message'=>'Slider Deleted Successfully',
            'alert-type'=>'info'
        );


        return redirect()->back()->with($notification);

    }
    public function SliderInactive($id){

        Slider::findOrFail($id)->update([
            'status'=> 0 ,

        ]);
        $notification = array(
			'message' => 'Slider InActive Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    }//end mathod

    public function SliderActive($id){

        Slider::findOrFail($id)->update([
            'status'=> 1 ,

        ]);
        $notification = array(
			'message' => 'Slider Active Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    }//end mathod


}
