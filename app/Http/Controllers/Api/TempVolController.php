<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProcessingResource;
use App\Http\Resources\TempVolResource;
use App\Models\Processing;
use App\Models\TempVol;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TempVolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tempVol = TempVol::all();
        return TempVolResource::collection($tempVol);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $tempCards = TempVol::updateOrCreate($request->all());
        return new TempVolResource($tempCards);
    }

    /**
     * Display the specified resource.
     */
    public function show(TempVol $tempVol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TempVol $tempVol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TempVol $tempVol)
    {
        //
        $tempVol->updateOrCreate($request->all());
        return new TempVolResource($tempVol);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TempVol $tempVol)
    {
        //
        $tempVol->delete();
        return response(null, 204);
    }

    public function UkurVolTimbangan(Request $request){
        // $request->validate([
        //     'nokartu' => 'required',
        // ]);
        $vol = $request->input('volume');
        $hapus = TempVol::truncate();
        // $rfidNasabahFind     = Nasabah::where("nokartu",$noRFID)->count();
        // $rfidNasabah = Nasabah::where("nokartu",$noRFID)->get();

        if ($hapus){
            // $tempCards = TempCard::create($request->all());
            $simpanRFID=TempVol::updateOrCreate([
                'volume'=>$vol,
                'created_at'=>Carbon::now(),
            ]);
            if ($simpanRFID) {
                $notification = array(
                    'status'=>true,
                    'alert-type' => 'success',
                    'volume'=>$vol,
                    'created_at'=>Carbon::now(),
                );
            }else{
                $notification = array(
                    'status'=>false,
                    'alert-type' => 'error'
                );
            }
        }else{
            $notification = array(
                'status'=>false,
                'alert-type' => 'error'
            );
        }
        return response()->json($notification);
    }
}