<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Artikel;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default users
        User::create([
            'nama' => 'Admin Utama',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        User::create([
            'nama' => 'Guru Contoh',
            'username' => 'guru',
            'password' => Hash::make('guru123'),
            'role' => 'guru'
        ]);

        User::create([
            'nama' => 'Siswa Contoh',
            'username' => 'siswa',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa'
        ]);

        // Create sample users
        User::factory(10)->create(['role' => 'siswa']);
        User::factory(5)->create(['role' => 'guru']);

        // Create categories
        $kategoris = [
            'Berita Sekolah',
            'Kegiatan',
            'Prestasi',
            'Karya Siswa',
            'Teknologi',
            'Olahraga',
            'Seni Budaya'
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create(['nama_kategori' => $kategori]);
        }

        // Create sample articles
        $kategoriIds = Kategori::pluck('id_kategori')->toArray();
        $userIds = User::pluck('id_user')->toArray();

        for ($i = 0; $i < 20; $i++) {
            Artikel::create([
                'judul' => $this->generateRandomTitle(),
                'isi' => $this->generateRandomContent(),
                'tanggal' => now()->subDays(rand(1, 30)),
                'id_user' => $userIds[array_rand($userIds)],
                'id_kategori' => $kategoriIds[array_rand($kategoriIds)],
                'status' => ['draft', 'pending', 'published'][rand(0, 2)]
            ]);
        }
    }

    private function generateRandomTitle()
    {
        $titles = [
            'Hari Guru Nasional di Sekolah Kami',
            'Peringatan Hari Kemerdekaan RI',
            'Lomba Karya Tulis Siswa Berhasil',
            'Kunjungan Industri ke Perusahaan Teknologi',
            'Workshop Kreativitas dan Inovasi',
            'Pentingnya Pendidikan Karakter',
            'Perkembangan Teknologi di Dunia Pendidikan',
            'Prestasi Gemilang Siswa dalam Olimpiade',
            'Kegiatan Bakti Sosial Siswa',
            'Pameran Karya Seni Siswa',
            'Seminar Literasi Digital untuk Siswa',
            'Pentingnya Bahasa Inggris di Era Global',
            'Kegiatan Outbound untuk Pembentukan Karakter',
            'Lomba Debat Bahasa Indonesia',
            'Festival Budaya Nusantara'
        ];

        return $titles[array_rand($titles)];
    }

    private function generateRandomContent()
    {
        $content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\n\n";
        
        $content .= "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n\n";
        
        $content .= "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.\n\n";
        
        $content .= "Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.";
        
        return $content;
    }
}