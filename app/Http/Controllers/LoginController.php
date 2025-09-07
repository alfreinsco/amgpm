<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginField = $request->input('login');
        $password = $request->input('password');

        // Tentukan apakah login menggunakan email atau whatsapp
        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'whatsapp';

        // Format phone number if login uses whatsapp
        if ($fieldType === 'whatsapp') {
            $loginField = formatPhoneNumber($loginField);
        }

        // Cari user berdasarkan email atau whatsapp
        $user = User::where($fieldType, $loginField)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'login' => ['Kredensial yang diberikan tidak cocok dengan catatan kami.'],
            ]);
        }

        // Login user
        Auth::login($user, $request->boolean('remember'));

        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
