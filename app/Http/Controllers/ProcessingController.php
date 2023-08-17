<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Manufacture;
use App\Models\Processing;
use App\Models\Source;
use App\Models\TempCard;
use App\Models\Type;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
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
            'nasabahs','sources','types','manufactures','inventories')
            ->where('remark', '=', 'in')->get();
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
            'source_id' => 'required',
            'type_id' => 'required',
            'manufacture_id' => 'required',
            'volume' => 'required',
            'rfid' => 'required:nasabahs,nokartu',
        ]);
        $sourcesID =$request->source_id;
        $typesID =$request->type_id;
        $manufacturesID =$request->manufacture_id;
        $nasabahsID =$request->nasabahs_id;
        $RFID =$request->rfid;
        // $matchAndThese = ['types_id' => $typesID, 'another_field' => 'another_value'];
        // $matchAndThese = ['types_id' => $typesID];
        // if you need another group of wheres as an alternative:
        // $matchOrThose = ['yet_another_field' => 'yet_another_value'];
        // with another group
        // $results = User::where($matchThese)
        // ->orWhere($orThose)
        // ->get();

        // $inventories = Inventory::where($matchAndThese)->get();
        // $inventories = Inventory::get();
        $inventories = Inventory::where('types_id', '=', $typesID)
        ->with('types','products')
        ->get();
        $notification = array();
        foreach ($inventories as $inv) {
            $notification = array(
                'message' => 'Sources Create Successfully',
                'alert-type' => 'success',
                'id'         => $inv->id,
                'Types'         => $inv->types->nama,
                'vol'      => $inv->volume,
            );
            $volLast = $inv->volume;
            $typeName = $inv->types->nama;
        }
        // return response()->json($notification);
        // $volLast = $inv->volume;
        $volIn = $request->volume;
        $totalVolNow = $volIn+$volLast;

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
            'alert-type' => 'success',
            'Type' => $typeName,
            'vol In' => $volIn,
            'total Vol Now' => $totalVolNow,
        );

        // return redirect()->back()->with($notification);
        return response()->json($notification);
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
