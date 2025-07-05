<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /**
     * Tampilkan form register.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Tangani proses pendaftaran.
     */
    public function register(Request $request)
    {
        // Validasi data form
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,manajer,staff'],
        ]);

        // Simpan user baru
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        // Event registered (jika ingin menggunakan event listener)
        event(new Registered($user));

        // Login otomatis
        Auth::login($user);

        // Redirect sesuai role
        return $this->redirectToDashboard($user);
    }

    /**
     * Redirect berdasarkan role.
     */
    protected function redirectToDashboard($user)
    {
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'manajer':
                return redirect()->route('manajer.dashboard');
            case 'staff':
                return redirect()->route('staff.dashboard');
            default:
                abort(403, 'Peran pengguna tidak dikenal atau tidak memiliki akses dashboard.');
        }
    }
}
