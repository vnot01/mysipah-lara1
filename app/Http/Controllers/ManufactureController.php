<?php

namespace App\Http\Controllers;

use App\Models\Manufacture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class ManufactureController extends Controller
{
    //
    public function AllManufactures(): View
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $listManufactures = Manufacture::latest()->get();
        return view('main.mastermanufactures.index', [
            'profileData'=>$profileData,
            'listManufactures' => $listManufactures]);
    }
    public function NewManufactures(): View
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        // $listTSources = Source::latest()->paginate(10);
        $listManufactures = Manufacture::latest()->get();
        return view('main.mastermanufactures.create', [
            'profileData'=>$profileData,
            'listManufactures' => $listManufactures]);
    }
    public function StoreManufactures(Request $request)
    {
        $request->validate([
            'manufacture_name' => 'required|unique:manufactures,nama|max:200',
        ]);

        Manufacture::insert([
            'nama'=>$request->manufacture_name,
        ]);

        $notification = array(
            'message' => 'Manufactures Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function Store2Manufactures(Request $request)
    {
        $request->validate([
            'manufacture_name' => 'required|unique:manufactures,nama|max:200',
        ]);

        Manufacture::insert([
            'nama'=>$request->manufacture_name,
        ]);

        $notification = array(
            'message' => 'Manufactures Create Successfully',
            'alert-type' => 'success'
        );

        // $id=Auth::user()->id;
        // $profileData = User::find($id);
        // $listManufactures = Manufacture::latest()->get();

        // return view('main.mastermanufactures.index', [
        //     'profileData'=>$profileData,
        //     'listManufactures' => $listManufactures])->with($notification);
        return redirect()->back()->with($notification);
    }
    public function EditManufactures($id)
    {
        $sourceData = Manufacture::find($id);
        return response()->json([
            'status'=>true,
            'data'=>$sourceData,
        ]);
    }

    public function UpdateManufactures(Request $request)
    {
        $request->validate([
            'manufacture_id' => 'required',
            'edit_manufacture_name' => 'required|unique:manufactures,nama|max:200',
        ]);
        $id = $request->manufacture_id;
        $manufactureData = Manufacture::find($id);
        $manufactureData -> nama = $request->input('edit_manufacture_name');
        $manufactureData -> update();
        $notification = array(
            'message' => 'Manufactures Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function DestroyManufactures($id)
    {
        //get post by ID
        $post = Manufacture::findOrFail($id);
        //delete post
        $post->delete();
        $notification = array(
            'message' => 'Manufactures Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}