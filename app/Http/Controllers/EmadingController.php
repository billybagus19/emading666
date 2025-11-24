<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Like;

use App\Models\Komentar;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EmadingController extends Controller
{
    public function index()
    {
        $artikels = Artikel::where('status', 'published')
            ->with(['user', 'kategori', 'likes', 'komentars'])
            ->orderBy('created_at', 'desc')
            ->paginate(6);
            
        $kategoris = Kategori::all();
        
        return view('emading.index', compact('artikels', 'kategoris'));
    }

    public function showArtikel($id)
    {
        $artikel = Artikel::with(['user', 'kategori', 'likes', 'komentars.user'])
            ->where('status', 'published')
            ->findOrFail($id);
            
        $artikelTerbaru = Artikel::where('status', 'published')
            ->where('id_artikel', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        return view('emading.show', compact('artikel', 'artikelTerbaru'));
    }

    public function likeArtikel(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);
        $user = Auth::user();
        
        $existingLike = Like::where('id_artikel', $id)
            ->where('id_user', $user->id_user)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
            
            LogAktivitas::create([
                'id_user' => $user->id_user,
                'aksi' => 'Unlike Artikel: ' . $artikel->judul,
                'waktu' => now()
            ]);
        } else {
            Like::create([
                'id_artikel' => $id,
                'id_user' => $user->id_user
            ]);
            $liked = true;
            
            LogAktivitas::create([
                'id_user' => $user->id_user,
                'aksi' => 'Like Artikel: ' . $artikel->judul,
                'waktu' => now()
            ]);
        }

        $totalLikeCount = $artikel->likes()->count();

        return response()->json([
            'liked' => $liked,
            'likeCount' => $totalLikeCount
        ]);
    }

    public function komentarArtikel(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'isi_komentar' => 'required|string|max:1000'
        ]);

        $user = Auth::user();
        $artikel = Artikel::findOrFail($id);

        Komentar::create([
            'id_artikel' => $id,
            'id_user' => $user->id_user,
            'isi_komentar' => $request->isi_komentar
        ]);

        // Log aktivitas komentar
        LogAktivitas::create([
            'id_user' => $user->id_user,
            'aksi' => 'Komentar Artikel: ' . $artikel->judul,
            'waktu' => now()
        ]);

        return redirect()->route('emading.show', $id)->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function kategori($id)
    {
        $artikels = Artikel::where('status', 'published')
            ->where('id_kategori', $id)
            ->with(['user', 'kategori', 'likes', 'komentars'])
            ->orderBy('created_at', 'desc')
            ->paginate(6);
            
        $kategori = Kategori::findOrFail($id);
        $kategoris = Kategori::all();
        
        return view('emading.kategori', compact('artikels', 'kategori', 'kategoris'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $artikels = Artikel::where('status', 'published')
            ->where(function($q) use ($query) {
                $q->where('judul', 'like', "%{$query}%")
                  ->orWhere('isi', 'like', "%{$query}%");
            })
            ->with(['user', 'kategori', 'likes', 'komentars'])
            ->orderBy('created_at', 'desc')
            ->paginate(6);
            
        $kategoris = Kategori::all();
        
        return view('emading.search', compact('artikels', 'query', 'kategoris'));
    }


}