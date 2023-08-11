<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TempCardResource;
use App\Models\TempCard;
use Illuminate\Http\Request;

class TempCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tempCards = TempCard::all();
        return TempCardResource::collection($tempCards);
    }

    public function ScanKartu(Request $request){
        // $request->validate([
        //     'nokartu' => 'required',
        // ]);
        $hapus = TempCard::truncate();
        // if ($hapus){
        //     $tempCard = new TempCard();
        //     $tempCard -> nokartu = $nokartu->input('nokartu');
        //     $tempCard -> save();
        // }
        // $notification = array(
        //     'message' => 'Manufactures Update Successfully',
        //     'alert-type' => 'success'
        // );
        // return response()->json($tempCard);
        if ($hapus){
            $tempCards = TempCard::create($request->all());
        }
        return new TempCardResource($tempCards);
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
        $tempCards = TempCard::create($request->all());
        
        return new TempCardResource($tempCards);
    }

    /**
     * Display the specified resource.
     */
    public function show(TempCard $tempCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TempCard $tempCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TempCard $tempCard)
    {
        //
        $tempCard->update($request->all());
        
        return new TempCardResource($tempCard);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TempCard $tempCard)
    {
        //
        $tempCard->delete();

        return response(null, 204);
    }
}
