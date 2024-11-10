<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    //
    public function general_setting(Request $request){
        if($request->input()){
            $request->validate([
                'site_logo'=>'image|mimes:jpg,jpeg,png,svg',
                'site_name'=>'required',
                'site_title'=>'required',
                'footer_desc'=>'required',
                'cur_format'=>'required',
                'theme_color'=>'required',
                'tax'=>'required',
                'phone'=>'required',
                'email'=>'required',
                'address'=>'required',
                'latitude'=>'required',
                'longitude'=>'required',
            ]);

            if($request->logo != ''){
                $path = public_path().'/site-images/';

                //code for remove old file
                if($request->old_logo != '' && $request->old_logo != null){
                    $file_old = $path.$request->old_logo;
                    if(file_exists($file_old)){
                        unlink($file_old);
                    }
                }

                //upload new file
                $file = $request->logo;
                $filename = $request->logo->getClientOriginalName();
                $file->move($path, $filename);
            }else{
                $filename = $request->old_logo;
            }

            $update = DB::table('general_settings')->update([
                'site_logo'=>$filename,
                'site_name'=>$request->site_name,
                'site_title'=>$request->site_title,
                'footer_desc'=>$request->footer_desc,
                'cur_format'=>$request->cur_format,
                'theme_color'=>$request->theme_color,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'address'=>$request->address,
                'latitude'=>$request->latitude,
                'longitude'=>$request->longitude,
                'tax'=>$request->tax,
            ]);
            return $update;
        }else{
            $settings = DB::table('general_settings')->get();
            return view('admin.settings.general',['data'=>$settings]);
        }
    }

    public function yb_change_password(Request $request){
    
        if($request->input()){
            $request->validate([
                'password'=> 'required',
                'new_pass'=> 'required',
                're_pass'=> 'required',
            ]);
            // return Hash::make($request->new);
            $get_admin = DB::table('admin')->first();

                if(Hash::check($request->password,$get_admin->password)){
                    DB::table('admin')->update([
                        'password'=>Hash::make($request->re_pass)
                    ]);
                    return '1';
                }else{
                    return 'Please Enter Correct Current Password';
                }
        }
    }

    public function yb_profile_settings(Request $request){
    
        if($request->input()){
            $request->validate([
                'admin_name'=> 'required',
                'admin_email'=> 'required|email:rfc',
                'username'=> 'required',
            ]);

            $update = DB::table('admin')->update([
                'admin_name'=>$request->admin_name,
                'admin_email'=>$request->admin_email,
                'username'=>$request->username,
            ]);
            return $update;

        }else{
            $settings = DB::table('admin')->first();
            return view('admin.settings.profile',['data'=>$settings]);
        }
    }

    public function banner_settings(Request $request){
        if($request->input()){
            $request->validate([
                'title'=>'required',
                'img'=>'image|mimes:jpg,jpeg,png,svg',
            ]);

            if($request->img != ''){
                $path = public_path().'/banner/';

                //code for remove old file
                if($request->old_img != '' && $request->old_img != null){
                    $file_old = $path.$request->old_img;
                    if(file_exists($file_old)){
                        unlink($file_old);
                    }
                }

                //upload new file
                $file = $request->img;
                $filename = $request->img->getClientOriginalName();
                $file->move($path, $filename);
            }else{
                $filename = $request->old_img;
            }

            $update = DB::table('banner')->update([
                'title'=>$request->title,
                'banner_img'=>$filename,
            ]);
            return $update;
        }else{
            $banner = DB::table('banner')->get();
            return view('admin.settings.banner',['data'=>$banner]);
        }
    }

    public function yb_social_settings(Request $request){
        if($request->input()){
            $update = DB::table('social_links')->update([
                'instagram'=>$request->instagram,
                'twitter'=>$request->twitter,
                'facebook'=>$request->facebook,
            ]);
            return $update;
        }else{
            $social = DB::table('social_links')->get();
            return view('admin.settings.social',['social'=>$social]);
        }
    }


}
