<?php

namespace App\Http\Controllers;
use App\Models\Inventory;
use App\Models\Manufacture;
use App\Models\Nasabah;
use App\Models\Processing;
use App\Models\Source;
use App\Models\TempCard;
use App\Models\Type;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    //
    private $remarkIn ='in';
    private $remarkOut ='out';
    private $remarkWarehouse ='warehouse';
    public function incomingWasteIndex(): View
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        // $listProcessings = Processing::latest()->get();
        $listSources = Source::all();
        $listTypes = Type::all();
        $listManufactures = Manufacture::all();
        $listInventory = Inventory::with(
            'sources','types','manufactures','products')
            // ->where('remark', '=', $this->remarkIn)
            ->get();
        $listProcessings = Processing::with(
            'nasabahs','sources','types','manufactures','namaNasabah')
            // ->where('remark', '=', $this->remarkIn)
            ->get();
        return view('main.inventories.index', [
            'profileData'=>$profileData,
            'listInventory'=>$listInventory,
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
        // $remark ='in';
        $sourcesID =$request->source_id;
        $typesID =$request->type_id;
        $typesName =$request->type_name;
        $manufacturesID =$request->manufacture_id;
        // $nasabahsID =$request->nasabahs_id;/
        $RFID =$request->rfid;
        // $matchAndThese = ['types_id' => $typesID, 'another_field' => 'another_value'];
        // $matchAndThese = ['types_id' => $typesID];
        // if you need another group of wheres as an alternative:
        // $matchOrThose = ['yet_another_field' => 'yet_another_value'];
        // with another group
        // $results = User::where($matchThese)
        // ->orWhere($orThose)
        // ->get();
        // nasabahCanProcess
        $cekNasabah = Nasabah::with('user')
            ->where('nokartu','=',$RFID)
            ->get();
        // $cekNasabah = Processing::with('namaNasabah')
        //     ->where('nokartu','=',$RFID)
        //     ->get();
        if ($cekNasabah) {
            foreach ($cekNasabah as $dataNasabah) {
                $noKartu = $dataNasabah->nokartu;
                $namaNasabah = $dataNasabah->user->name;
                $idNasabah = $dataNasabah->id;
            }
            if (!empty($noKartu)) {
                $inventories = Inventory::where('types_id', '=', $typesID)
                    ->with('types','products')
                    ->get();
                $cekDataInv = Inventory::where('types_id', '=', $typesID)->exists();
                $notification = array();
                $vol = 0;
                if ($cekDataInv) {
                    foreach ($inventories as $inv) {
                        if (is_null($inv->volume)) {
                            $vol = 0;
                        }else{
                            $vol = $inv->volume;
                        }
                        // $notification = array(
                        //     'message' => 'Sources Create Successfully',
                        //     'alert-type' => 'success',
                        //     'id'         => $inv->id,
                        //     'Types'         => $inv->types->nama,
                        //     'vol'      => $vol,
                        // );
                        $volLast = $vol;
                        $typeName = $inv->types->nama;
                    }
                }else{
                    $volLast = $vol;
                    $typeName = $typesName;
                }
                // return response()->json($notification);
                // $volLast = $inv->volume;
                $volIn = $request->volume;
                $totalVolNow = $volIn+$volLast;
                // Processing::insert([
                //     'sources_id'=>$sourcesID,
                //     'types_id'=>$typesID,
                //     'manufactures_id'=>$manufacturesID,
                //     'nokartu'=>$RFID,
                //     'volume'=>$volIn,
                //     'total_volume'=>$totalVolNow,
                //     'nasabahs_id'=>$idNasabah,
                //     'remark'=>$this->remarkIn,
                //     'created_at'=>Carbon::now(),
                // ]);
        
                $notification = array(
                    'message' => 'Incoming Process Waste Create Successfully',
                    'alert-type' => 'success',
                    'Type' => $typeName,
                    'vol In' => $volIn,
                    'total Vol Now' => $totalVolNow,
                    'noKartu' => $noKartu,
                    'idNasabah' => $idNasabah,
                    'namaNasabah' => $namaNasabah,
                );
            }else{
                $notification = array(
                    'message' => 'Incoming Process Waste Failed',
                    'alert-type' => 'error'
                );
            }
        }else{
            $notification = array(
                'message' => 'Incoming Process Waste Failed',
                'alert-type' => 'error'
            );
        }

        return redirect()->back()->with($notification);
        // return response()->json($notification);
        // return response()->json($cekNasabah);
        // return response()->json($RFID);
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
