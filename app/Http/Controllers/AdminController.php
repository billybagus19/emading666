<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\User;
use App\Models\LogAktivitas;
use App\Models\Kategori;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminController extends Controller
{
    public function dashboard()
    {
        $totalArtikel = Artikel::count();
        $totalArtikelPublished = Artikel::where('status', 'published')->count();
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalGuru = User::where('role', 'guru')->count();
        
        $artikelsPending = Artikel::where('status', 'pending')
            ->with(['user', 'kategori'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('admin.dashboard', compact(
            'totalArtikel', 'totalArtikelPublished', 'totalSiswa', 'totalGuru', 'artikelsPending'
        ));
    }

    public function artikels()
    {
        $artikels = Artikel::with(['user', 'kategori'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('admin.artikels.index', compact('artikels'));
    }

    public function showArtikel($id)
    {
        $artikel = Artikel::with(['user', 'kategori', 'likes', 'komentars.user'])
            ->findOrFail($id);
            
        return view('admin.artikels.show', compact('artikel'));
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

        // Log aktivitas publish artikel
        LogAktivitas::create([
            'id_user' => Auth::id(),
            'aksi' => 'Publish Artikel: ' . $artikel->judul,
            'waktu' => now()
        ]);

        return redirect()->route('admin.artikels')->with('success', 'Artikel berhasil dipublish.');
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

        // Log aktivitas reject artikel
        LogAktivitas::create([
            'id_user' => Auth::id(),
            'aksi' => 'Reject Artikel: ' . $artikel->judul . ' - Alasan: ' . $request->alasan_penolakan,
            'waktu' => now()
        ]);

        return redirect()->route('admin.artikels')->with('success', 'Artikel berhasil direject dengan alasan.');
    }
    
    public function destroyArtikel($id)
    {
        $artikel = Artikel::findOrFail($id);
        
        // Hapus foto jika ada
        if ($artikel->foto) {
            \Storage::disk('public')->delete($artikel->foto);
        }
        
        // Hapus semua data terkait artikel
        $artikel->likes()->delete();
        $artikel->komentars()->delete();
        $artikel->notifikasis()->delete();
        
        $judulArtikel = $artikel->judul;
        $artikel->delete();
        
        // Log aktivitas hapus artikel
        LogAktivitas::create([
            'id_user' => Auth::id(),
            'aksi' => 'Hapus Artikel: ' . $judulArtikel,
            'waktu' => now()
        ]);
        
        return redirect()->route('admin.artikels')->with('success', 'Artikel berhasil dihapus.');
    }

    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function usersSiswa()
    {
        $users = User::where('role', 'siswa')->orderBy('created_at', 'desc')->get();
        $title = 'Daftar Siswa';
        return view('admin.users.index', compact('users', 'title'));
    }

    public function usersGuru()
    {
        $users = User::where('role', 'guru')->orderBy('created_at', 'desc')->get();
        $title = 'Daftar Guru';
        return view('admin.users.index', compact('users', 'title'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:siswa,guru,admin',
            'kelas' => 'nullable|string|max:255',
        ]);

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'kelas' => $request->role === 'siswa' ? $request->kelas : null,
        ]);

        return redirect()->route('admin.users')->with('success', 'User berhasil ditambahkan.');
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id . ',id_user',
            'role' => 'required|in:siswa,guru,admin',
            'kelas' => 'nullable|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'role' => $request->role,
            'kelas' => $request->role === 'siswa' ? $request->kelas : null,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('admin.users')->with('success', 'User berhasil diperbarui.');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->id_user === Auth::id()) {
            return redirect()->route('admin.users')->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        // Hapus semua data terkait user
        $user->artikels()->delete();
        $user->likes()->delete();
        $user->komentars()->delete();
        $user->logAktivitas()->delete();
        
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User dan semua data terkait berhasil dihapus.');
    }

    public function kategori()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori'
        ]);

        Kategori::create(['nama_kategori' => $request->nama_kategori]);

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function updateKategori(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori,' . $id . ',id_kategori'
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update(['nama_kategori' => $request->nama_kategori]);

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroyKategori($id)
    {
        $kategori = Kategori::findOrFail($id);
        
        // Cek apakah kategori masih digunakan
        if ($kategori->artikels()->count() > 0) {
            return redirect()->route('admin.kategori')->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh artikel.');
        }

        $kategori->delete();
        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil dihapus.');
    }

    public function laporan()
    {
        $artikels = Artikel::whereIn('status', ['published', 'rejected'])
            ->with(['user', 'kategori'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('admin.laporan.index', compact('artikels'));
    }

    public function generatePDF()
    {
        $artikels = Artikel::whereIn('status', ['published', 'rejected'])
            ->with(['user', 'kategori'])
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.laporan.pdf', compact('artikels'));
        return $pdf->download('laporan-artikel-' . date('Y-m-d') . '.pdf');
    }



    public function logAktivitas()
    {
        $logs = LogAktivitas::with('user')
            ->orderBy('waktu', 'desc')
            ->paginate(20);
            
        return view('admin.log.index', compact('logs'));
    }

    public function userDetail($id)
    {
        $user = User::with(['artikels', 'logAktivitas'])->findOrFail($id);
        return view('admin.users.detail', compact('user'));
    }
}