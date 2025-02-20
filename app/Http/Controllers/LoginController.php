<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Validation\ValidationException;
use Exception;


class LoginController extends Controller
{
    protected $redirectTo = '/dashboard';

    public function index(): \Illuminate\Contracts\View\View {
        return view('login.index',
        [
            'hidup' => 'login',
        ]);
    }

    public function authenticate(Request $request) {
        // Validasi email dan password
        // dd($request->all());
        $credentials =  $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // dd('Berhasil Login');
        // Validasi untuk email belum terdaftar atau password salah
        // if(Auth::attempt($credentials)){
        //     $request->session()->regenerate();

        //     return redirect()->intended('dashboard');
        // }
        // return back()->with('loginError', 'Terjadi Kesalahan, Login Gagal');

        try {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                session()->flash('success', 'Login Berhasil!'); // Menggunakan flash agar session hilang setelah dibaca
                return redirect()->intended('dashboard');
            }
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
            } catch (ValidationException $e) {
                return back()->with('loginError', $e->getMessage());
            } catch (Exception $e) {
                return back()->with('loginError', 'Terjadi kesalahan sistem: ' . $e->getMessage());
            }
    }

    public function logout(Request $request) {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/')->with('logoutMessage', 'Anda Telah Logout!');
    }
}
