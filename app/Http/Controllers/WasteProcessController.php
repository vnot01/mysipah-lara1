<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Source;
use App\Models\TempCard;
use App\Models\Type;
use App\Models\User;
use App\Models\Manufacture;
use App\Models\Nasabah;
use App\Models\Processing;
use App\Models\ProcessingStatus;

class WasteProcessController extends Controller
{
    //
    private $remarkIn ='in';
    private $remarkOut ='out';
    private $remarkWarehouse ='warehouse';
    public function WasteProcessIndex()
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        // $listProcessings = Processing::latest()->get();
        $listSources = Source::all();
        $listTypes = Type::all();
        $listManufactures = Manufacture::all();
        $listProcessings = Processing::with(
            'nasabahs','sources','types','manufactures','namaNasabah')
            ->where('remark', '=', $this->remarkWarehouse)
            ->get();
        $listProcessingsStatus = ProcessingStatus::with(
            'products','processingHasProducts','processings')
            // ->where('remark', '=', $this->remarkWarehouse)
            ->get();

        // return response()->json($listProcessingsStatus);

        return view('main.wasteprocess.index', [
            'profileData'=>$profileData,
            'listProcessings' => $listProcessings,
            'listSources'=>$listSources,
            'listTypes'=>$listTypes,
            'listManufactures'=>$listManufactures,
            'listProcessingsStatus'=>$listProcessingsStatus]);
    }
}
