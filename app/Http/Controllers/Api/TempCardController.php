<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TempCardResource;
use App\Models\Nasabah;
use App\Models\TempCard;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Encryption\Encrypter;

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
        $plainText = $request->input('id');
        // Our custom encryption key:
        $key = 'U2x2QdvosFTtk5nL0ejrKqLFP1tUDtSt';
        // $key = '012345678910111213141516171819202122232425262728293031';
        $encrypter = new Encrypter(
            key: $key,
            cipher: config('app.cipher'),
        );
        $noRFID = $encrypter->encrypt($plainText);

        // $noRFID = $encrypter->decrypt($plainText);
        // $encryptString  = $request->input('id');
        // // $notification = array(
        // //     'status'=>false,
        // //     'alert-type' => 'error',
        // //     'message' => $encryptString
        // // );
        // try {
        //     $decrypted = Crypt::decryptString($encryptString);
        //     $noRFID = $decrypted;
        // } catch (DecryptException $e) {
        //     $notification = array(
        //         'status'=>false,
        //         'alert-type' => 'error',
        //         'message' => 'DecryptException'
        //     );
        // }

        // $noRFID = $request->input('id');
        // $encryptString = $request->input('id');
        // $noRFID = Crypt::encryptString($encryptString);
        $hapus = TempCard::truncate();
        $rfidNasabahFind     = Nasabah::where("nokartu",$noRFID)->count();
        $rfidNasabah = Nasabah::where("nokartu",$noRFID)->get();

        if ($hapus){
            // $tempCards = TempCard::create($request->all());
            $simpanRFID=TempCard::updateOrCreate([
                'nokartu'=>$noRFID,
                'created_at'=>Carbon::now(),
            ]);
            if ($simpanRFID) {
                if( $rfidNasabahFind ==0 ){
                    $notification = array(
                        'status'=>true,
                        'alert-type' => 'success',
                        'No RFID' => $noRFID,
                        'created_at'=>Carbon::now(),
                        // 'qty'=>$rfidNasabahFind,
                    );
                    // return response()->json([
                    //     'status'=>true,
                    //     'No RFID' => $noRFID,
                    //     'qty'=>$rfidNasabahFind,
                    // ]);
                }else{
                    $notification = array(
                        'status'=>true,
                        'alert-type' => 'success',
                        'No RFID' => $noRFID,
                        'qty'=>$rfidNasabahFind,
                        'data'=>$rfidNasabah
                    );
                }
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

        // $data = [];
        // $rfidNasabah = TempCard::latest()->get();
        // if ($hapus){
        //     // $tempCards = TempCard::create($request->all());
        //     TempCard::insert([
        //         'nokartu'=>$noRFID,
        //     ]);
        //     // if(is_null($rfidNasabah)){
        //     //     $notification = array(
        //     //         'message' => 'Sources Create Successfully',
        //     //         'alert-type' => 'success',
        //     //         'data'         => $noRFID,
        //     //     );
        //     // }else{
        //         // foreach ( $rfidNasabah as $a ) {
        //         //     $notification = array(
        //         //         'message' => 'Sources Create Successfully',
        //         //         'alert-type' => 'success',
        //         //         'id'         => $a->id,
        //         //         'nokartu'      => $a->nokartu,
        //         //     );
        //         // }
        //         $notification = array(
        //             'message' => 'Sources Create Successfully',
        //             'alert-type' => 'success',
        //                 'data'         => $rfidNasabah,
        //         );
        //     // }

        // }
        // return new TempCardResource($tempCards);
        return response()->json($notification);
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
        $tempCards = TempCard::updateOrCreate($request->all());
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
        $tempCard->updateOrCreate($request->all());
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
