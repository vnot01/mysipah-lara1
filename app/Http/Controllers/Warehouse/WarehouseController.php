<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
    //
    public function WarehouseDashboard(){

        return view('warehouse.warehouse_dashboard');
    }
    
    /**
     * Destroy an authenticated session.
     */
    public function WarehouseLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
