<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\Yb_AdminController;
use App\Http\Controllers\SeatLayoutController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\AssignedController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });
Route::group(['middleware'=>'installed'], function(){

    Route::get('/',[HomeController::class,'index']);
    Route::any('/all-busbooking',[HomeController::class,'all_busbooking']);
    Route::any('/ticketbooking/{id}',[HomeController::class,'ticketbooking']);
    Route::get('/confirm-ticket',[HomeController::class,'confirm_ticket']);
    Route::get('/contact',[HomeController::class,'contact']);
    Route::post('/contact',[HomeController::class,'contact_form']);
    Route::get('/signup',[UserController::class,'create']);
    Route::post('/signup',[UserController::class,'store']);
    Route::get('/userlogin', [UserController::class, 'login'])->name('user.login');
    Route::post('/userlogin', [UserController::class, 'login_form'])->name('user.login.form');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/changepassword',[UserController::class,'changepassword']);
    Route::post('/changepassword',[UserController::class,'change_password']);
    Route::get('/paypal',function(){
        return view('confirm-ticket');
    });
    
    Route::post('/paypal', [PaymentController::class, 'payWithpaypal'])->name('paypal');
    Route::get('/status', [PaymentController::class, 'getPaymentStatus'])->name('status');
    Route::get('/payment-failed', [PaymentController::class, 'payment_failed']);
    Route::get('/my-bookings',[UserController::class,'my_bookings']);
    Route::get('/my-profile',[UserController::class,'my_profile']);
    Route::post('/updateprofile',[UserController::class,'updateprofile']);


    Route::group(['middleware'=>['protectedPage']],function(){
        Route::any('admin',[Yb_AdminController::class,'yb_index']);
        Route::post('admin/logout',[Yb_AdminController::class,'yb_logout']);
        Route::any('admin/change-password',[SettingsController::class,'yb_change_password']);
        Route::get('admin/dashboard',[Yb_AdminController::class,'yb_dashboard']);
        Route::any('admin/profile-settings',[SettingsController::class,'yb_profile_settings']);
        Route::any('admin/banner-settings',[SettingsController::class,'banner_settings']);
        Route::any('admin/social-settings',[SettingsController::class,'yb_social_settings']);
        Route::any('admin/general-settings',[SettingsController::class,'general_setting']);
        Route::resource('admin/seat-layout',SeatLayoutController::class);
        Route::resource('admin/fleettype',FleetController::class);
        Route::resource('admin/vehicle',VehicleController::class);
   
        Route::get('admin/vehicle/create', [VehicleController::class, 'create'])->name('admin.vehicle.create');
        Route::post('admin/vehicle/store', [VehicleController::class, 'store'])->name('admin.vehicle.store');

        Route::resource('admin/facility',FacilityController::class);
        Route::resource('admin/location',LocationController::class);
        Route::get('/admin/location/create', [LocationController::class, 'create'])->name('location.create');
        Route::post('/admin/location/create', [LocationController::class, 'store'])->name('location.store');
        Route::delete('location/{id}', [LocationController::class, 'destroy'])->name('location.destroy');
        Route::resource('admin/route',RouteController::class);
        Route::resource('admin/ticket-price',TicketController::class);
        Route::resource('admin/trip',TripController::class);
        Route::resource('admin/contact',ContactController::class);
        Route::get('admin/contact/{id}/view',[ContactController::class,'Contactview']);
        Route::resource('admin/booking',BookingController::class);
        Route::get('admin/booking/{id}/view',[BookingController::class,'Bookingview']);
        Route::resource('admin/users',UserController::class);
        Route::get('admin/users', [UserController::class, 'index']);  
        Route::get('users', [UserController::class, 'getUsersData']); 
        Route::post('admin/users/block',[UserController::class,'changeStatus']);
    });
});
