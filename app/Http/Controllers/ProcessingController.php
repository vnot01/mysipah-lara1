<?php

namespace App\Http\Controllers;

use App\Models\Manufacture;
use App\Models\Processing;
use App\Models\Source;
use App\Models\Type;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcessingController extends Controller
{
    //
    public function incomingWasteIndex(): View
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        // $listProcessings = Processing::latest()->get();
        $listSources = Source::all();
        $listTypes = Type::all();
        $listManufactures = Manufacture::all();
        $listProcessings = Processing::with(
            'nasabahs','sources','types','manufactures','locations')->get();
        return view('main.incomingwaste.index', [
            'profileData'=>$profileData,
            'listProcessings' => $listProcessings,
            'listSources'=>$listSources,
            'listTypes'=>$listTypes,
            'listManufactures'=>$listManufactures]);
    }

    public function StoreNewIncomingWaste(Request $request)
    {
        $request->validate([
            'source_id' => 'required:sources',
            'type_id' => 'required:types',
            'manufacture_id' => 'required:manufactures',
            'volume' => 'required',
            'rfid' => 'required:nasabahs,nokartu',
        ]);
        // $volLast =
        // $volIn = $request->volume;
        // $totalVol = $volIn+$volLast;

        // Processing::insert([
        //     'sources_id'=>$request->sources_id,
        //     'types_id'=>$request->types_id,
        //     'manufactures_id'=>$request->manufactures_id,
        //     'nokartu'=>$request->rfid,
        //     'volume'=>$request->volume,
        //     'total_volume'=>$request->total_volume,
        //     'nasabahs_id'=>$request->nasabahs_id,
        // ]);

        $notification = array(
            'message' => 'Incoming Process Waste Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function DestroyIncomingWaste($id)
    {
        //get post by ID
        $post = Processing::findOrFail($id);
        //delete post
        $post->delete();
        $notification = array(
            'message' => 'Incoming Process Waste Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}