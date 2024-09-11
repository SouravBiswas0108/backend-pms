<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        // dd(123);
        $settings = Utility::settings();
        // dd($settings);
        return view('admin.auth.login', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function loginSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4',
        ]);
        // return Hash::make($request->password);
        $credentials = $request->only('email', 'password');
// dd();
        if (Auth::attempt($credentials)) {
            // Authentication was successful...
            $user = Auth::user();

            // Optionally, you can update the password if it hasn't been hashed yet
            // (though this should ideally be done during registration, not login)
            // $user->password = Hash::make($request->password);
            // $user->save();
            // dd(session()->user());
        return redirect()->route('admin.users.index');
            // return redirect->route('users');

            // return response()->json(['message' => 'Login successful'], 200);
        } else {
            // Authentication failed...
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

 
     public function logOut(Request $request){
        // dd(123);
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('admin.login')->with('status', 'You have been logged out successfully.');
     }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
