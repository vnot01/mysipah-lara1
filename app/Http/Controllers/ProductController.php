<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    //
    public function AllProducts(): View
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        $listProducts = Product::latest()->get();
        return view('main.masterproducts.index', [
            'profileData'=>$profileData,
            'listProducts' => $listProducts]);
    }
    public function NewProducts(): View
    {
        $id=Auth::user()->id;
        $profileData = User::find($id);
        // $listTSources = Source::latest()->paginate(10);
        $listProducts = Product::latest()->get();
        return view('main.masterproducts.create', [
            'profileData'=>$profileData,
            'listProducts' => $listProducts]);
    }
    public function StoreProducts(Request $request)
    {
        $request->validate([
            'product_name' => 'required|unique:products,nama|max:200',
        ]);

        Product::insert([
            'nama'=>$request->product_name,
        ]);

        $notification = array(
            'message' => 'Products Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function Store2Products(Request $request)
    {
        $request->validate([
            'product_name' => 'required|unique:products,nama|max:200',
        ]);

        Product::insert([
            'nama'=>$request->product_name,
        ]);

        $notification = array(
            'message' => 'Products Create Successfully',
            'alert-type' => 'success'
        );

        // $id=Auth::user()->id;
        // $profileData = User::find($id);
        // $listProducts = Product::latest()->get();

        // return view('main.masterproducts.index', [
        //     'profileData'=>$profileData,
        //     'listProducts' => $listProducts])->with($notification);
        return redirect()->back()->with($notification);
    }
    public function EditProducts($id)
    {
        $sourceData = Product::find($id);
        return response()->json([
            'status'=>true,
            'data'=>$sourceData,
        ]);
    }

    public function UpdateProducts(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'edit_product_name' => 'required|unique:products,nama|max:200',
        ]);
        $id = $request->product_id;
        $productData = Product::find($id);
        $productData -> nama = $request->input('edit_product_name');
        $productData -> update();
        $notification = array(
            'message' => 'Products Update Successfully',
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
    public function DestroyProducts($id)
    {
        //get post by ID
        $post = Product::findOrFail($id);
        //delete post
        $post->delete();
        $notification = array(
            'message' => 'Products Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
