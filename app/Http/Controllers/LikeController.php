<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LikeController extends Controller
{
    public function likePostingan($id) {
        $postingan = Postingan::where('id', $id)->first();
        // dd($postingan);

        if (!$postingan) {
            dd('sini', [
                'message' => 'Not Found Data',
            ]);
            return response()->json([
                'message' => 'Not Found Data',
            ], 404);
        }
        dd('lanjut', [
            'message' => 'Unlike berhasil',
            'likes' => 'adi' . $postingan->likes()->count() // Mengembalikan jumlah like terbaru like.count class
        ]);
        $user = Auth::user();

        // Cek apakah user sudah like postingan ini
        $existingLike = Like::where('postingan_id', $postingan->id)
                            ->where('user_id', $user->id)
                            ->first();

        if ($existingLike) {
            // Jika sudah like, hapus like (unlike)
            $existingLike->delete();

            return response()->json([
                'message' => 'Unlike berhasil',
                'likes' => 'adi' . $postingan->likes()->count() // Mengembalikan jumlah like terbaru like.count class
            ]);
        }

        // Jika belum like, tambahkan like baru dalam transaksi
        try {
            DB::beginTransaction();

            if (!isset($postingan->id)) {
                return response()->json([
                    'message' => 'Error: postingan ID tidak ditemukan!',
                ], 400);
            }
            Like::create([
                'postingan_id' => $postingan->id,
                'user_id' => $user->id
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Berhasil like',
                'likes' => $postingan->likes()->count() // Mengembalikan jumlah like terbaru like.count class
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error saat like postingan', [
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Gagal Like',
                'likes' => 'rizal' . $postingan->likes()->count(), // Tetap mengembalikan jumlah like terbaru
                'status' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString(),
                // digunakan ketika ada masalah saat proses koneksi dengan database
            ], 500);
        }
    }
}

