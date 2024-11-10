<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use App\Models\Vehicle;
use App\Models\Booking;

use Illuminate\Http\Request;

class Yb_AdminController extends Controller
{
    //
    public function yb_index(Request $request){

		if($request->input()){

			$request->validate([
				'username'=>'required',
				'password'=>'required',
			]); 
			
			$login = DB::table('admin')->where(['username'=>$request->username])->pluck('password')->first();

			if(empty($login)){
				return response()->json(['username'=>'Username Does not Exists']);
			}else{
				if(Hash::check($request->password,$login)){
					$admin = DB::table('admin')->first();
					$request->session()->put('admin','1');
					$request->session()->put('admin_name',$admin->admin_name);
					return '1';
					// return response()->json(['success'=>'1']);
				}else{
					return response()->json(['password'=>'Username and Password does not matched']);
				}
			}
			
		}else{
			 return view('admin.admin');
		}
		
    }

   	public function yb_dashboard(){

		$data['vehicles'] = Vehicle::count();
        $data['users'] = Users::count();
        $data['booking'] = Booking::count();
        $data['latest_booking'] = Booking::select(['booking.*','trips.title as trip_name','users.name as user_name'])
		->leftjoin('trips','booking.trip_id','=','trips.id')
		->leftjoin('users','users.user_id','=','booking.user_id')
		->orderBy('id', 'desc')->take(5)->get();

        return view('admin.dashboard',$data);
	}
    
    public function yb_logout(Request $req){
		Auth::logout();
		session()->forget('admin');
		session()->forget('username');
		return '1';
	}
}
