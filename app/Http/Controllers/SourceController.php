<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Source;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class SourceController extends Controller
{
    //
    public function AllSources(): View
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        // $listTSources = Source::latest()->paginate(10);
        $listTSources = Source::latest()->get();
        return view('main.mastersources.index', [
            'profileData'=>$profileData,
            'listSources' => $listTSources]);
    }
    public function AddSources(): View
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        // $listTSources = Source::latest()->paginate(10);
        $listTSources = Source::latest()->get();
        return view('main.mastersources.index', [
            'profileData'=>$profileData,
            'listSources' => $listTSources]);
    }
    public function StoreSources(Request $request)
    {
        $request->validate([
            'source_name' => 'required|unique:sources,nama|max:200',
        ]);

        Source::insert([
            'nama'=>$request->source_name,
        ]);

        $notification = array(
            'message' => 'Sources Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function EditSources($id)
    {
        $sourceData = Source::find($id);
        return response()->json([
            'status'=>true,
            'data'=>$sourceData,
        ]);
        // $notification = array(
        //     'message' => 'Sources Create Successfully',
        //     'alert-type' => 'success'
        // );
        // return redirect()->back()->with($notification);
    }

    public function UpdateSources(Request $request)
    {
        $request->validate([
            'source_id' => 'required',
            'edit_source_name' => 'required|unique:sources,nama|max:200',
        ]);
        $id = $request->source_id;
        $sourceData = Source::find($id);
        $sourceData -> nama = $request->input('edit_source_name');
        $sourceData -> update();
        $notification = array(
            'message' => 'Sources Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function masterSourcesEdit(): View
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $listTSources = Source::latest()->paginate(5);
        return view('main.mastersources.index', ['profileData'=>$profileData,'listSources' => $listTSources]);
    }

    // public function masterSourcesShow(): View
    // {
    //     $id=Auth::user()->id;
    //     $profileData = User::find($id);
    //     $listTSources = Source::latest()->paginate(5);
    //     return view('main.mastersources.index', ['profileData'=>$profileData,'listSources' => $listTSources]);
    // }

    public function masterSourcesDestroy(): View
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $listTSources = Source::latest()->paginate(5);
        return view('main.mastersources.index', ['profileData'=>$profileData,'listSources' => $listTSources]);
    }
}