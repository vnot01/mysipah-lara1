<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Permission\Traits\HasRoles;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        $rute = '';
        if ($request->user()->role === 'admin') {
            // $rute = '/admin/dashboard';
            // return redirect()->intended(RouteServiceProvider::ADMIN);
            $rute = RouteServiceProvider::ADMIN;
        } elseif ($request->user()->role === 'operator') {
            // $rute = '/operator/dashboard';
            // return redirect()->intended(RouteServiceProvider::OPERATOR);
            $rute = RouteServiceProvider::OPERATOR;
        } elseif ($request->user()->role === 'warehouse') {
            // $rute = '/warehouse/dashboard';
            // return redirect()->intended(RouteServiceProvider::WAREHOUSE);
            $rute = RouteServiceProvider::WAREHOUSE;
        } elseif ($request->user()->role === 'user') {
            // return redirect()->intended(RouteServiceProvider::ADMIN);
            $rute = RouteServiceProvider::ADMIN;
        } else {
            // $rute = '/dashboard';
            // return redirect()->intended(RouteServiceProvider::HOME);
            $rute = RouteServiceProvider::HOME;
        }
        return redirect()->intended($rute);
        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}