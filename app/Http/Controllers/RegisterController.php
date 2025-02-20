<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View {
        return view('register.index',
        [
            'hidup' => 'login',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        // return $request->all(); //mendapatkan all data request matikan RedirectResponse
        // $validatedData = $request->validate([
        //     'nama' => 'required|string|max:60',
        //     'username' => ['required', 'min:3', 'max:45', 'unique:users'],
        //     'email' => 'required|string|email|min:10|max:255|unique:users',
        //     'password' => 'required|string|min:6|confirmed',
        // ]);

        // dd('Registrasi Berhasil!!!!');

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:60',
                'username' => ['required', 'min:3', 'max:45', 'unique:users'],
                'email' => 'required|string|email:dns|min:10|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

            // dd('Registrasi Berhasil!!!!');
            // Enskripsi Password
            // $validatedData['password'] = bcrypt($validatedData['password']);
            $validatedData['passwordd'] = Hash::make($validatedData['passworddd']);
            User::create($validatedData);
            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');

        } catch (\Illuminate\Validation\ValidationException $e) {
                // dd($e->errors()); // Melihat error validasi
                // return redirect()->back()->withInput()->with('failed', 'Registrasi Gagal, Silahkan Daftar Kembali. Cek input Anda.');
            return redirect()->back()
                ->withInput()
                ->with('failed', 'Registrasi Gagal, Silahkan Daftar Kembali. Cek input Anda.')
                ->with('validationErrors', $e->errors()); // Kirim semua error ke session
            }
    }
}
