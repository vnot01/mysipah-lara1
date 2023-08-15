<?php

namespace App\Http\Controllers;

use App\Models\Processing;
use App\Models\User;
use Illuminate\Contracts\View\View;
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
        $listProcessings = Processing::with(
            'nasabahs','sources','types','manufactures','locations')->get();
        return view('main.incomingwaste.index', [
            'profileData'=>$profileData,
            'listProcessings' => $listProcessings]);
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
