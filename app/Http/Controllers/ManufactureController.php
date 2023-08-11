<?php

namespace App\Http\Controllers;

use App\Models\Manufacture;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManufactureController extends Controller
{
    //
    public function AllManufactures(): View
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $listManufactures = Manufacture::latest()->get();
        return view('main.masterManufactures.index', [
            'profileData'=>$profileData,
            'listManufactures' => $listManufactures]);
    }
    public function NewManufactures(): View
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        // $listTSources = Source::latest()->paginate(10);
        $listManufactures = Manufacture::latest()->get();
        return view('main.masterManufactures.create', [
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
            'type_id' => 'required',
            'edit_type_name' => 'required|unique:manufactures,nama|max:200',
        ]);
        $id = $request->type_id;
        $typeData = Manufacture::find($id);
        $typeData -> nama = $request->input('edit_manufacture_name');
        $typeData -> update();
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
