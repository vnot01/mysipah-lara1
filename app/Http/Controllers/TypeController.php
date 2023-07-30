<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class TypeController extends Controller
{
    //
    public function AllTypes(): View
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $listTypes = Type::latest()->get();
        return view('main.mastertypes.index', [
            'profileData'=>$profileData,
            'listTypes' => $listTypes]);
    }
    public function NewTypes(): View
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        // $listTSources = Source::latest()->paginate(10);
        $listTypes = Type::latest()->get();
        return view('main.mastertypes.create', [
            'profileData'=>$profileData,
            'listTypes' => $listTypes]);
    }
    public function StoreTypes(Request $request)
    {
        $request->validate([
            'type_name' => 'required|unique:types,nama|max:200',
        ]);

        Type::insert([
            'nama'=>$request->type_name,
        ]);

        $notification = array(
            'message' => 'Types Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function EditTypes($id)
    {
        $sourceData = Type::find($id);
        return response()->json([
            'status'=>true,
            'data'=>$sourceData,
        ]);
    }

    public function UpdateTypes(Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'edit_type_name' => 'required|unique:types,nama|max:200',
        ]);
        $id = $request->type_id;
        $typeData = Type::find($id);
        $typeData -> nama = $request->input('edit_type_name');
        $typeData -> update();
        $notification = array(
            'message' => 'Types Update Successfully',
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
    public function DestroyTypes($id)
    {
        //get post by ID
        $post = Type::findOrFail($id);
        //delete post
        $post->delete();
        $notification = array(
            'message' => 'Types Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

}