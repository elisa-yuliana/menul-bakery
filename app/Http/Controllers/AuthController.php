<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LoginHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    // --- STAFF/UMUM SECTION ---
    public function showLoginForm() {
        return view('auth.login');
    }

   public function login(Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // SIMPAN HISTORI LOGIN DISINI
        LoginHistory::create([
            'user_id'    => Auth::id(),
            'name'       => Auth::user()->name,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'login_at'   => now(),
        ]);

        return redirect()->intended(route('dashboard.index'));
    }

    return back()->withErrors(['email' => 'Email atau password salah.']);
}

    public function showRegisterForm() {
        return view('auth.register');
    }

   public function register(Request $request) {
    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:2',
    ]);

    $validated['password'] = Hash::make($validated['password']);
    $validated['role'] = 'staff'; 

    User::create($validated);

    // LOGIKA KRUSIAL:
    // Jika yang mendaftarkan adalah Admin yang sedang login
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.users.index')->with('success', 'Staff baru berhasil didaftarkan.');
    }

    // Jika pendaftaran dilakukan oleh orang umum (Guest)
    return redirect()->route('login')->with('success', 'Pendaftaran berhasil, silakan login.');
}

    // --- ADMIN SECTION (Tambahan Baru) ---

    public function showAdminLoginForm() {
        return view('auth.admin-login'); // Pastikan file ini ada
    }

    public function adminLogin(Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        if (Auth::user()->role === 'admin') {
            $request->session()->regenerate();

            // SIMPAN HISTORI LOGIN DISINI
            LoginHistory::create([
                'user_id'    => Auth::id(),
                'name'       => Auth::user()->name,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'login_at'   => now(),
            ]);

            return redirect()->intended(route('dashboard.index'));
        }

        Auth::logout();
        return back()->withErrors(['email' => 'Anda tidak memiliki hak akses Admin.']);
    }

    return back()->withErrors(['email' => 'Email atau password salah.']);
}

    public function showAdminRegisterForm() {
        return view('auth.admin-register'); // Pastikan file ini ada
    }

    public function adminRegister(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:2',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'admin'; // Paksa jadi admin karena lewat register khusus admin

        User::create($validated);

        return redirect()->route('admin.login')->with('success', 'Akun admin berhasil dibuat. Silakan login.'); // Setelah daftar admin, arahkan ke login admin untuk keamanan
    }

    // --- LOGOUT ---
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }


// ... di dalam class AuthController ...

public function index()
{
    // Mengambil semua user untuk daftar staff
    $users = User::all();
    
    // Mengambil 20 histori login terbaru untuk audit
    $histories = LoginHistory::orderBy('login_at', 'desc')->take(20)->get();

    return view('admin.kelola-staff', compact('users', 'histories'));
}

public function destroyStaff($id)
{
    $user = User::findOrFail($id);

    // Mencegah admin menghapus dirinya sendiri
    if ($user->id == Auth::id()) { // Auth::id() adalah fungsi bawaan Laravel
        return back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
    }

    $user->delete();
    return back()->with('success', 'Akses staff berhasil dicabut.');
}
}