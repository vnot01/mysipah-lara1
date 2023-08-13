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
use Illuminate\Support\Facades\DB;
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
        // $listUser = User::latest()->get();
        $listUser = DB::table('users')->get();
        // $dataNasabah = DB::table('nasabahs')->get();
        $scanKartu = TempCard::latest()->get();
        // return view('admin.index', compact('listTokens'));
        // return view('admin.index',compact('profileData'));
        // return view('admin.index',compact(['profileData','listTokens' => $listTokens]));
        return view('nasabah.index', [
            'profileData'=>$profileData,
            'listTokens' => $listTokens,
            'nasabahData' => $listNasabah,
            // 'dataNasabah' => $dataNasabah,
            'userData' => $listUser,
            'scanKartu' => $scanKartu]);
        // return response(view('admin.index', ['profileData' => $profileData,'listTokens'=>$listTokens]));
    }

    public function getTempCard(){
        $data = [];
        $childCategory = TempCard::latest()->get();
        foreach ( $childCategory as $childCat ) {
            $data =
            [
                'id'         => $childCat->id,
                'nokartu'      => $childCat->nokartu,
            ];
        }

        return response()->json($data);
        // return response()->json([
        //     'status' => 'success',
        //     'id' => $childCategory->id,
        //     'nokartu' => $childCategory->nokartu,
        // ]);
    }
    public function getNoKartu(): View {

        // $id=Auth::user()->id;
        // $profileData = User::find($id);
        // $listTokens = ApiToken::latest()->paginate(5);
        $scanKartu = TempCard::latest()->get();
        return view('nasabah.nokartu', [
            'scanKartu' => $scanKartu]);
    }

    public function StoreNewNasabah(Request $request)
    {
        $request->validate([
            'rfid' => 'required|unique:nasabahs,nokartu',
            'users_id' => 'required',
        ]);
        // $dataNasabah = DB::table('users')->get();
        // $evt = $dataNasabah->users_id;
        // $dataTempCard = DB::table('temp_cards')->get();
        // $insc = $request->input('nokartu');


        // $inscription = new Nasabah();
        // $inscription->users_id = $request->selectedID;
        // $inscription->nokartu = $request->nokartu;
        // $inscription->save();

        Nasabah::insert([
            'nokartu'=>$request->rfid,
            'users_id'=>$request->users_id,
        ]);

        $notification = array(
            'message' => 'Sources Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        /* $id=Auth::user()->id;
        $profileData = User::find($id);
        // $listTSources = Source::latest()->paginate(10);
        $listTSources = Source::latest()->get(); */

        //redirect to index
        /* return redirect()->route('all.sources')->with([
            $notification,
            'profileData'=>$profileData,
            'listSources' => $listTSources,
        ]); */

        // return view('main.mastersources.index', [
        //     'profileData'=>$profileData,
        //     'listSources' => $listTSources,
        //     $notification,
        // ]);
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