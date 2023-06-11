<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function AdminDashboard()
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.index',compact('profileData'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function AdminProfile()
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        
        return view('admin.admin_profile_view',compact('profileData'));
    }
     
    public function AdminProfileStore(Request $request)
    {
        $id=Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->photo = $request->photo;

        $target_dir = "upload/";
        // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        // $uploadOk = 1;
        // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
        $validateImageData = $request->validate([
            // 'image' => 'required',
            //     'image.*' => 'mimes:jpg,png,jpeg'
            'image' => 'mimes:jpeg,png,jpg',
            ]);
        if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imagePath = public_path($target_dir.'admin_images/'.$data->photo);
                if(File::exists($imagePath)){
                    Log::warning('File Exists');
                    File::delete($imagePath);
                }
                // @unlink(public_path($target_dir.'admin_images/'.$data->photo));
                $filename = $data->username.'.'.$file->getClientOriginalExtension();
                $file->move(public_path($target_dir.'admin_images') , $filename);
                $data['photo'] = $filename;
        }
        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );

        $data->save();
        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword(Request $request){        
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);
        if (!Hash::check($request->old_password,auth::user()->password)) {
            $notification = array(
                'message' => 'Old Password Doesn\'t Match',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
            
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }
}