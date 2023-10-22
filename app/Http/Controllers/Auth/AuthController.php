<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function index()
    {
        return view('auth.login');
    }

    public function home()
    {
        return view('home');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.update-profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::whereId(Auth::id())->first();
        $payload = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'whatsapp' => 'required|unique:users,whatsapp,' . $user->id,
            'password' => 'nullable|confirmed|min:8',
            'password_confirmation' => 'sometimes|required_with:password',
        ], [
            'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
            'whatsapp.unique' => 'Whatsapp sudah digunakan oleh pengguna lain.',
        ]);

        if ($request->password) {
            $payload['password'] = $request->password;
        } else {
            unset($payload['password']);
        }
        $user->update($payload);

        return back()->with('success', "Profile updated successfully.");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
