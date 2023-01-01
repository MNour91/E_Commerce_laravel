<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class AdminProfileController extends Controller
{
   public function Adminprofile(){
        $id = Auth::user()->id;
        $adminData = Admin::find($id);
       return view('admin.admin_profile_view',compact('adminData'));
   }

   public function AdminProfileEdit(){
        $id = Auth::user()->id;
	    $editData = Admin::find($id);;
    return view('admin.admin_profile_edit',compact('editData'));
   }

   public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = Admin::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images'),$data->profile_photo_path);
            $filename = date('YmdHi').".".$file->getClientOriginalExtension();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();
        $notification = array(
            'message'=>' Admin Profile Update Successfully ',
            'alert-type'=>'success'
        );


        return redirect()->route('admin.profile')->with($notification);


   }

   public function AdminChangePassword(){
       return view('admin.admin_password_edite');
   }
   public function AdminPasswordUpdate(Request $request){
        $validateData = $request->validate([
            'oldpassword'=>'required',
            'password'=>'required|confirmed',
        ]);
        $HashedPassword =Admin::find(Auth::id())->password;
        if(Hash::check($request->oldpassword, $HashedPassword)){
            $hashedPassword = Auth::user()->password;
            $admin->password = Hash::make($request->password);
            $admin->save();
            $notification = array(
                'message'=>' Admin Change Password Successfully ',
                'alert-type'=>'success'
            );
    
    
            return redirect()->route('admin.logout')->with($notification);
    
        }else{
            $notification = array(
                'message'=>'Current Password is Wrong',
                'alert-type'=>'warning'
            );
    
    
            return redirect()->back()->with($notification);
        }

   }

    public function AllUsers(){
        $users = User::latest()->get();
     return view('backend.user.all_user',compact('users'));
    }

}
