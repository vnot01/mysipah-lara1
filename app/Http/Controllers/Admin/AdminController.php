<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiToken;
use App\Models\Source;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Laravel\Sanctum\PersonalAccessToken;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AdminDashboard()
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $listTokens = ApiToken::latest()->paginate(5);
        // return view('admin.index', compact('listTokens'));

        // return view('admin.index',compact('profileData'));
        // return view('admin.index',compact(['profileData','listTokens' => $listTokens]));
        return view('admin.index', ['profileData'=>$profileData,'listTokens' => $listTokens]);
        // return response(view('admin.index', ['profileData' => $profileData,'listTokens'=>$listTokens]));
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
        $listTokens = ApiToken::latest()->paginate(5);
        // return view('admin.admin_profile_view',compact('profileData'));

        return view('admin.admin_profile_view', ['profileData'=>$profileData,'listTokens' => $listTokens]);
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
        // $data->photo = $request->photo;

        $target_dir = "upload/";
        // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        // $uploadOk = 1;
        // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        // $this->$request->validate([
        //     // 'image' => 'required',
        //     //     'image.*' => 'mimes:jpg,png,jpeg'
        //     'image' => 'image|mimes:jpeg,png,jpg',
        //     ]);
        if ($request->hasFile('image')) {
            $data->photo = $request->photo;
            $this->validate($request, [
                'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg',]);
                if (!empty($request->file('image'))){
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

        }
        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );

        $data->save();
        return redirect()->back()->with($notification);
        // toast('Your Post as been submited!','success');
        // return redirect()->back()->alert()->success('Success','Profile Updated Successfully');
    }

    public function AdminChangePassword(Request $request)
    {
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
        // toast('Your Post as been submited!','success');
        // return back()->alert()->success('Success','Password Change Successfully');

    }

    public function membuatToken(Request $request)
    {
        // if (! Auth::attempt($request->only('email', 'password'))) {
        //     return response()->json([
        //         'message' => 'Unauthorized'
        //     ], 401);
        // }
        $id=Auth::user()->id;
        $data = User::find($id);
        // $user = User::where('email', $request->email)->firstOrFail();

        // $data->token_name = $request->token_name;

        $token = $data->createToken($request->token_name)->plainTextToken;
        $dataToken = PersonalAccessToken::findToken($token);
        // $user = $token1->tokenable;
        ApiToken::create([
            'personal_access_id'=> $dataToken->id,
            'tokenable_id'=> $dataToken->id,
            'uuid'=> $data->id,
            'api_tokens'        => $token,
            'token_type'=>'Bearer'
        ]);

        $notification = array(
            'message' => 'Token Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

        // toast('Your Post as been submited!','success');
        // return redirect()->back()->alert()->success('Success','Token Create Successfully');
        // return redirect()->back()->withSuccess('Token Create Successfully');
    }
    public function lihatToken(): View
    {
        // $id=Auth::user()->id;
        // $posts = ApiToken::find($id);
        $listTokens = ApiToken::latest()->paginate(5);
        return view('admin.admin_profile_view', with(compact('listTokens')));
    }

    public function hapusToken(Request $request)
    {
        $request->validate([
            'id_token' => 'required',
        ]);
        PersonalAccessToken::whereId($request->id_token)->delete([
            'id' => $request->id_token
        ]);
        $notification = array(
            'message' => 'Token Delete Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);

        // toast('Your Post as been submited!','success');
        // return back()->with('Success','Token Delete Successfully');
    }

    // public function incomingWasteIndex(): View
    // {
    //     $id=Auth::user()->id;
    //     $profileData = User::find($id);
    //     $listTokens = ApiToken::latest()->paginate(5);
    //     // return view('admin.index', compact('listTokens'));

    //     // return view('admin.index',compact('profileData'));
    //     // return view('admin.index',compact(['profileData','listTokens' => $listTokens]));
    //     return view('main.incomingwaste.index', [
    //         'profileData'=>$profileData,
    //         'listTokens' => $listTokens
    //     ]);
    // }

    // public function masterSourcesIndex(): View
    // {
    //     $id=Auth::user()->id;
    //     $profileData = User::find($id);
    //     $listTSources = Source::latest()->paginate(5);
    //     return view('main.mastersources.index', ['profileData'=>$profileData,'listSources' => $listTSources]);
    // }

    // public function masterSourcesEdit(): View
    // {
    //     $id=Auth::user()->id;
    //     $profileData = User::find($id);
    //     $listTSources = Source::latest()->paginate(5);
    //     return view('main.mastersources.index', ['profileData'=>$profileData,'listSources' => $listTSources]);
    // }

    // public function masterSourcesShow(): View
    // {
    //     $id=Auth::user()->id;
    //     $profileData = User::find($id);
    //     $listTSources = Source::latest()->paginate(5);
    //     return view('main.mastersources.index', ['profileData'=>$profileData,'listSources' => $listTSources]);
    // }

    // public function masterSourcesDestroy(): View
    // {
    //     $id=Auth::user()->id;
    //     $profileData = User::find($id);
    //     $listTSources = Source::latest()->paginate(5);
    //     return view('main.mastersources.index', ['profileData'=>$profileData,'listSources' => $listTSources]);
    // }
}