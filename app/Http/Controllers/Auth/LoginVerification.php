<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginVerification extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)
            ->orWhere('username', $request->email)->first();

        if ($user !== null && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->remember ?? false);
        }

        return redirect(route('dashboard'))->with('success', 'Berhasil Melakukan Login');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect(RouteServiceProvider::HOME);
    }
}
