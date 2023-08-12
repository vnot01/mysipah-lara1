<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\ApiToken;
use App\Models\Nasabah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\Source;
use App\Models\TempCard;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class NasabahController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function NasabahDashboard()
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $listTokens = ApiToken::latest()->paginate(5);
        $listNasabah = Nasabah::with('user')->get();
        // $listNasabah = Nasabah::latest()->get();
        $listUser = User::latest()->get();
        $limitedUser = User::latest()->limit(5)->get();
        $scanKartu = TempCard::latest()->get();


        // return view('admin.index', compact('listTokens'));
        // return view('admin.index',compact('profileData'));
        // return view('admin.index',compact(['profileData','listTokens' => $listTokens]));
        return view('nasabah.index', [
            'profileData'=>$profileData,
            'listTokens' => $listTokens,
            'nasabahData' => $listNasabah,
            'userData' => $listUser,
            'userLimitedData' => $limitedUser,
            'scanKartu' => $scanKartu]);
        // return response(view('admin.index', ['profileData' => $profileData,'listTokens'=>$listTokens]));
    }

    public function getTempCard()
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $listTokens = ApiToken::latest()->paginate(5);
        $getScanKartu = TempCard::latest()->get();
        // $getScanKartu = Member::where('cnic',$request->cnic)->first();
        // generate the select input
        // $output = '';
        // $output .= '<select name="select-name">';

        // // generate the options for the select
        // foreach ($statuses as $status) {
        //     $output .= '<option value="' . $status->id . '">' . $status->name . '</option>';
        // }

        // // close the select input
        // $output .= '</select>';


        return response()->json($getScanKartu, 200);
    }

    public function membuatToken(Request $request)
    {
        $id=Auth::user()->id;
        $data = User::find($id);
        $token = $data->createToken($request->token_name)->plainTextToken;
        $dataToken = PersonalAccessToken::findToken($token);
        // $user = $token1->tokenable;
        // ApiToken::create([
        //     'personal_access_id'=> $dataToken->id,
        //     'tokenable_id'=> $dataToken->id,
        //     'uuid'=> $data->id,
        //     'api_tokens'        => $token,
        //     'token_type'=>'Bearer'
        // ]);

        $notification = array(
            'message' => 'Token Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

        // toast('Your Post as been submited!','success');
        // return redirect()->back()->alert()->success('Success','Token Create Successfully');
        // return redirect()->back()->withSuccess('Token Create Successfully');
    }

}