<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\User;
use App\Models\Kategori;
use App\Models\LogAktivitas;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    public function dashboard()
    {
        $totalArtikel = Artikel::count();
        $totalArtikelPublished = Artikel::where('status', 'published')->count();
        $totalSiswa = User::where('role', 'siswa')->count();
        
        $artikelsPending = Artikel::where('status', 'pending')
            ->with(['user', 'kategori'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        return view('guru.dashboard', compact(
            'totalArtikel', 'totalArtikelPublished', 'totalSiswa', 'artikelsPending'
        ));
    }

    public function artikels()
    {
        $artikels = Artikel::with(['user', 'kategori'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('guru.artikels.index', compact('artikels'));
    }

    public function showArtikel($id)
    {
        $artikel = Artikel::with(['user', 'kategori'])
            ->findOrFail($id);
            
        return view('guru.artikels.show', compact('artikel'));
    }

    public function publishArtikel($id)
    {
        $artikel = Artikel::findOrFail($id);
        $artikel->update(['status' => 'published']);

        // Buat notifikasi untuk siswa
        Notifikasi::create([
            'id_user' => $artikel->id_user,
            'id_artikel' => $artikel->id_artikel,
            'judul' => 'Artikel Disetujui',
            'pesan' => 'Artikel "' . $artikel->judul . '" telah disetujui dan dipublikasikan.',
            'tipe' => 'approved'
        ]);

        LogAktivitas::create([
            'id_user' => Auth::id(),
            'aksi' => 'ACC Artikel: ' . $artikel->judul,
            'waktu' => now()
        ]);

        return redirect()->route('guru.artikels')->with('success', 'Artikel berhasil di-ACC dan dipublish.');
    }

    public function rejectArtikel(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|max:1000'
        ]);

        $artikel = Artikel::findOrFail($id);
        $artikel->update([
            'status' => 'rejected',
            'alasan_penolakan' => $request->alasan_penolakan
        ]);

        // Buat notifikasi untuk siswa
        Notifikasi::create([
            'id_user' => $artikel->id_user,
            'id_artikel' => $artikel->id_artikel,
            'judul' => 'Artikel Ditolak',
            'pesan' => 'Artikel "' . $artikel->judul . '" ditolak. Alasan: ' . $request->alasan_penolakan,
            'tipe' => 'rejected'
        ]);

        LogAktivitas::create([
            'id_user' => Auth::id(),
            'aksi' => 'Reject Artikel: ' . $artikel->judul . ' - Alasan: ' . $request->alasan_penolakan,
            'waktu' => now()
        ]);

        return redirect()->route('guru.artikels')->with('success', 'Artikel berhasil di-reject dengan alasan.');
    }
}