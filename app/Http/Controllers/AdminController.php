<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate(['email' => ['required', 'email'], 'password' => ['required', 'string']]);
        $user = User::where('email', $credentials['email'])->where('is_admin', true)->first();

        if (! $user || ! Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Those credentials could not be verified.'])->onlyInput('email');
        }

        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }

    public function dashboard()
    {
        return view('admin.dashboard', ['bookings' => Booking::with(['service', 'schedule'])->latest()->get()]);
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $booking->update($request->validate(['status' => ['required', 'in:pending,confirmed,completed,cancelled']]));
        return back()->with('status', 'Booking status updated.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }
}