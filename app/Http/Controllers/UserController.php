<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Booking;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax()){
            $data = Users::latest()->orderBy('user_id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if($row->status == '1'){
                        $btn = '<button class="btn btn-warning btn-sm userBlock" data-status="'.$row->status.'" data-id="'.$row->user_id.'">Block</button>';
                    }else{
                        $btn = '<button class="btn btn-success btn-sm userBlock" data-status="'.$row->status.'" data-id="'.$row->user_id.'">Unblock</button>';
                    }
                    return $btn;
                })
                ->make(true);
        }
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Session::has('user_name')){
            return redirect('/');
        }else{
            $general_settings = DB::table('general_settings')->get();
            $social = DB::table('social_links')->get();
            return view('/signup',['general_settings'=>$general_settings,'social'=>$social]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'phone'=>'required',
            'city'=>'required',
            'state'=>'required',
            'code'=>'required',
            'country'=>'required',
            'password'=>'required',
        ]);

        $user = new Users();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->pin_code = $request->input('code');
        $user->country = $request->input('country');
        $user->password = Hash::make($request->input('password'));
        $u = $user->save();
        return $u;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeStatus(Request $request){
        if($request->post()){
            $id = $request->post('uId');
            $status = $request->post('status');

            $user = Users::where('user_id',$id)->update([
                'status' => $status,
            ]);
            return $user;
        }
    }

    // public function signup(){
    //     if(Session::has('user_name')){
    //         return redirect('/');
    //     }else{
    //         $general_settings = DB::table('general_settings')->get();
    //         $social = DB::table('social_links')->get();
    //         return view('/signup',['general_settings'=>$general_settings,'social'=>$social]);
    //     }
    // }

    // public function signup_form(Request $request){
    //     $request->validate([
    //         'name'=>'required',
    //         'email'=>'required|unique:users,email',
    //         'phone'=>'required',
    //         'city'=>'required',
    //         'state'=>'required',
    //         'code'=>'required',
    //         'country'=>'required',
    //         'password'=>'required',
    //     ]);

    //     $user = new Users();
    //     $user->name = $request->input('name');
    //     $user->email = $request->input('email');
    //     $user->phone = $request->input('phone');
    //     $user->city = $request->input('city');
    //     $user->state = $request->input('state');
    //     $user->pin_code = $request->input('code');
    //     $user->country = $request->input('country');
    //     $user->password = Hash::make($request->input('password'));
    //     $u = $user->save();
    //     return $u;
    // }

    public function login(){
        if(Session::has('user_name')){
            return redirect('/');
        }else{
            $general_settings = DB::table('general_settings')->get();
            $social = DB::table('social_links')->get();
            return view('/userlogin',['general_settings'=>$general_settings,'social'=>$social]);
        }
    }

    public function login_form(Request $request){
        if($request->input()){

            $request->validate([
                'username'=>'required',
                'password'=>'required',
            ]);

            $login = Users::where(['email'=>$request->username])->first();

            if(empty($login)){
                return response()->json(['username'=>'Username Does not Exists.']);
            }else if($login->status == '0') {
                return response()->json(['username'=>'The Email / Username is Blocked.']);
            }else{
                if(Hash::check($request->password,$login->password)){
                    $request->session()->put('user','1');
                    $request->session()->put('user_name',$login->name);
                    $request->session()->put('user_id',$login->user_id);
                    return '1';
                }else{
                    return response()->json(['password'=>'Username and Password does not matched.']);
                }
            }
        }else{
            return view('/userlogin');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['user', 'user_name', 'user_id']);
        return redirect('/userlogin');
    }
    
    
    

    public function changepassword(){
        if(session()->has('user_name')){
            $general_settings = DB::table('general_settings')->get();
            $social = DB::table('social_links')->get();
            return view('/changepassword',['general_settings'=>$general_settings,'social'=>$social]);
        }else{
            return redirect('/userlogin');
        }
    }

    public function change_password(Request $request){
        if($request->input()){
            $request->validate([
                'password'=>'required',
                'new_pass'=>'required',
                're_pass'=>'required'
            ]);

            $id = session()->get('user_id');

            $select = Users::select(['users.*'])->where('user_id',$id)->pluck('password');
            if(Hash::check($request->password,$select[0])){
                $update = Users::select(['users.*'])->where('user_id',$id)->update([
                    'password'=>Hash::make($request->new_pass)
                ]);
                return '1';
            }else{
                return response()->json(['password'=>'Please Enter Correct Old Password']);
            }
        }
    }

    public function my_profile(){
        if(session()->has('user_name')){
            $general_settings = DB::table('general_settings')->get();
            $social = DB::table('social_links')->get();
            $user = Users::where(['user_id'=>session()->get('user_id')])->first();
            return view('/my_profile',['general_settings'=>$general_settings,'social'=>$social,'user'=>$user]);
        }else{
            return redirect('/userlogin');
        }
    }

    // public function updateprofile($id){
    //     $user = Users::where(['user_id'=>$id])->first();
    //     return response()->json([
    //         'status'=>200,
    //         'user'=>$user,
    //     ]);
    // }

    public function updateprofile(Request $request){
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'city'=>'required',
            'state'=>'required',
            'country'=>'required',
            'code'=>'required',
        ]);
        $id = session()->get('user_id');
        $user = Users::where(['user_id'=>$id])->update([
            'name'=>$request->input('name'),
            'phone'=>$request->input('phone'),
            'city'=>$request->input('city'),
            'state'=>$request->input('state'),
            'country'=>$request->input('country'),
            'pin_code'=>$request->input('code'),
        ]);
        return $user;
    }

    public function my_bookings(){
        if(session()->has('user_name')){
            Paginator::useBootstrap();
            $my_bookings = Booking::select('booking.*','trips.title as trip_name','vehicles.name as vehicle_name','users.name as user_name')
                            ->leftjoin('trips','booking.trip_id','=','trips.id')
                            ->leftjoin('vehicles','vehicles.id','=','trips.vehicle')
                            ->leftjoin('users','users.user_id','=','booking.user_id')
                            ->where(['booking.user_id'=>session()->get('user_id')])
                            ->orderBy('booking.id','DESC')
                            ->paginate(10);
            return view('/my_bookings',['my_bookings'=>$my_bookings]);
        }else{
            return redirect('/userlogin');
        }
    }
}
