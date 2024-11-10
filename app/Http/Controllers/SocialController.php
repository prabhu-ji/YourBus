<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SocialController extends Controller
{
    //
    public function social_settings(Request $request){
        if($request->input()){
            $update = DB::table('social_links')->update([
                'instagram'=>$request->instagram,
                'twitter'=>$request->twitter,
                'facebook'=>$request->facebook,
            ]);
            return $update;
        }else{
            $social = DB::table('social_links')->get();
            return view('admin.social.social',['social'=>$social]);
        }
    }
}
