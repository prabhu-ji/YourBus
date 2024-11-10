<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use App\Models\Vehicle;
use App\Models\Booking;

class BannerController extends Controller
{
    public function banner_settings(Request $request)
    {
        if ($request->input()) {
            // Validate the request input
            $request->validate([
                'title' => 'required',
                'img' => 'image|mimes:jpg,jpeg,png,svg',
                'button_status' => 'required',
            ]);

            // Handle file upload or fallback to existing/default image
            if ($request->hasFile('img')) {
                $path = public_path() . '/banner/';

                // Remove old file if it exists
                if ($request->old_img != '' && $request->old_img != null) {
                    $file_old = $path . $request->old_img;
                    if (file_exists($file_old)) {
                        unlink($file_old);
                    }
                }

                // Upload new file
                $file = $request->file('img');
                $filename = $file->getClientOriginalName();
                $file->move($path, $filename);
            } else {
                // If no file is uploaded, use the existing or default image
                $filename = $request->old_img ?: 'default-banner.jpg';
            }

            // Update the banner record in the database
            $update = DB::table('banner')->update([
                'title' => $request->title,
                'banner_img' => $filename,
                'button_status' => $request->button_status,
            ]);

            // Return the update result (success or failure)
            return $update;
        } else {
            // Return the banner settings view with the current banner data
            $banner = DB::table('banner')->get();
            return view('admin.banner.banner', ['data' => $banner]);
        }
    }

    // Dashboard data
    public function dashboard()
    {
        $data['vehicles'] = Vehicle::count();
        $data['users'] = Users::count();
        $data['booking'] = Booking::count();
        return view('/admin/dashboard', $data);
    }
}
