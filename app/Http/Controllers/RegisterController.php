<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            DB::beginTransaction();

            $validatedData = $request->validate([
                'name' => 'required|string|max:60',
                'username' => ['required', 'min:3', 'max:45', 'unique:users'],
                'email' => 'required|string|email:dns|min:10|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

            // dd('Registrasi Berhasil!!!!');
            // Enskripsi Password
            // $validatedData['password'] = bcrypt($validatedData['password']);

            if (!isset($validatedData['password'])) {
                throw new \Exception('Kesalahan dalam input: password tidak ditemukan.');
            }

            $validatedData['password'] = Hash::make($validatedData['password']);

            // if (!isset($validatedData['password'])) {
            //     throw new \Throwable('Kesalahan dalam input password.');
            // }

            User::create($validatedData);

            DB::commit();

            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');

        } catch (\Throwable $e) {
            // dd($e->errors()); // Melihat error validasi
            // return redirect()->back()->withInput()->with('failed', 'Registrasi Gagal, Silahkan Daftar Kembali. Cek input Anda.');
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error saat registrasi', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            // Cek apakah error dari pengecekan password

            return redirect()->back()
                ->withInput()
                ->with('failed',  $e->getMessage())
                // ->with('validationErrors', json_encode(['error' => $e->getMessage()])); // Simpan error ke session
                ->with('validationErrors', json_encode(['error' => 'Kesalahan dalam Input password']));
        }
    }
}



