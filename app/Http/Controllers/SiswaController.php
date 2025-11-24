<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\LogAktivitas;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $artikels = Artikel::where('id_user', $user->id_user)
            ->with('kategori')
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Hitung statistik
        $totalArtikels = $artikels->count();
        $publishedArtikels = $artikels->where('status', 'published')->count();
        $pendingArtikels = $artikels->where('status', 'pending')->count();
            
        // Ambil notifikasi terbaru
        $notifikasis = Notifikasi::where('id_user', $user->id_user)
            ->with('artikel')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        return view('siswa.dashboard', compact('artikels', 'notifikasis', 'totalArtikels', 'publishedArtikels', 'pendingArtikels'));
    }

    public function createArtikel()
    {
        $kategoris = Kategori::all();
        return view('siswa.artikel.create', compact('kategoris'));
    }

    public function storeArtikel(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('posts', 'public');
        }

        $artikel = Artikel::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => now(),
            'id_user' => $user->id_user,
            'id_kategori' => $request->id_kategori,
            'foto' => $fotoPath,
            'status' => 'draft',
        ]);

        // Log aktivitas membuat artikel
        LogAktivitas::create([
            'id_user' => $user->id_user,
            'aksi' => 'Membuat Artikel: ' . $artikel->judul,
            'waktu' => now()
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Artikel berhasil disimpan sebagai draft.');
    }

    public function editArtikel($id)
    {
        $artikel = Artikel::findOrFail($id);
        $kategoris = Kategori::all();
        
        // Cek apakah artikel milik user yang sedang login
        if ($artikel->id_user !== Auth::id()) {
            abort(403);
        }
        
        return view('siswa.artikel.edit', compact('artikel', 'kategoris'));
    }

    public function updateArtikel(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);
        
        // Cek apakah artikel milik user yang sedang login
        if ($artikel->id_user !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = $artikel->foto;
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($artikel->foto) {
                Storage::disk('public')->delete($artikel->foto);
            }
            $fotoPath = $request->file('foto')->store('posts', 'public');
        }

        $updateData = [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'id_kategori' => $request->id_kategori,
            'foto' => $fotoPath,
        ];
        
        // Jika artikel sebelumnya ditolak, ubah status ke draft dan hapus alasan penolakan
        if ($artikel->status == 'rejected') {
            $updateData['status'] = 'draft';
            $updateData['alasan_penolakan'] = null;
        }
        
        $artikel->update($updateData);

        // Log aktivitas update artikel
        LogAktivitas::create([
            'id_user' => Auth::id(),
            'aksi' => 'Update Artikel: ' . $artikel->judul,
            'waktu' => now()
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function submitArtikel($id)
    {
        $artikel = Artikel::findOrFail($id);
        
        // Cek apakah artikel milik user yang sedang login
        if ($artikel->id_user !== Auth::id()) {
            abort(403);
        }

        // Update status ke pending dan hapus alasan penolakan jika ada
        $artikel->update([
            'status' => 'pending',
            'alasan_penolakan' => null
        ]);

        // Log aktivitas submit artikel
        $aksi = $artikel->wasChanged('alasan_penolakan') ? 
                'Resubmit Artikel setelah Perbaikan: ' . $artikel->judul :
                'Submit Artikel untuk Verifikasi: ' . $artikel->judul;
                
        LogAktivitas::create([
            'id_user' => Auth::id(),
            'aksi' => $aksi,
            'waktu' => now()
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Artikel berhasil disubmit untuk verifikasi guru.');
    }

    public function destroyArtikel($id)
    {
        $artikel = Artikel::findOrFail($id);
        
        // Cek apakah artikel milik user yang sedang login
        if ($artikel->id_user !== Auth::id()) {
            abort(403);
        }

        // Hapus foto jika ada
        if ($artikel->foto) {
            Storage::disk('public')->delete($artikel->foto);
        }

        $artikel->delete();

        // Log aktivitas hapus artikel
        LogAktivitas::create([
            'id_user' => Auth::id(),
            'aksi' => 'Hapus Artikel: ' . $artikel->judul,
            'waktu' => now()
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Artikel berhasil dihapus.');
    }
    
    public function markNotificationRead($id)
    {
        $notifikasi = Notifikasi::where('id_notifikasi', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();
            
        $notifikasi->update(['dibaca' => true]);
        
        return response()->json(['success' => true]);
    }
    
    public function markAllNotificationsRead()
    {
        Notifikasi::where('id_user', Auth::id())
            ->where('dibaca', false)
            ->update(['dibaca' => true]);
            
        return response()->json(['success' => true]);
    }
}