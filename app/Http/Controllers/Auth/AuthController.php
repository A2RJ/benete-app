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
        $email = Auth::user()->email;
        $user = User::whereEmail($email)->firstOrFail();

        // Untuk role admin
        if ($user->hasRole('admin')) {
            return redirect()->route('user.dashboard');
        }

        // Untuk role bidang keuangan
        if ($user->hasRole('bidang keuangan')) {
            return redirect()->route('keu.dashboard');
        }

        // Untuk role bidang kesyahbandaran
        if ($user->hasRole('bidang kesyahbandaran')) {
            return redirect()->route('kesya.dashboard');
        }

        // Untuk role bidang pengelola bmn dan persediaan
        if ($user->hasRole('bidang pengelola bmn dan persediaan')) {
            return redirect()->route('bmn.dashboard');
        }

        // Untuk role bidang kepegawaian atau tata usaha
        if ($user->hasRole('bidang kepegawaian atau tata usaha')) {
            return redirect()->route('tu.dashboard');
        }

        // Untuk role bidang kepelabuhan
        if ($user->hasRole('bidang kepelabuhan')) {
            return redirect()->route('pelabuhan.dashboard');
        }
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
