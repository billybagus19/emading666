# Fitur Penolakan Artikel dengan Alasan

## Deskripsi
Fitur ini memungkinkan admin/guru untuk menolak artikel siswa dengan memberikan alasan penolakan yang spesifik. Siswa akan menerima notifikasi berisi alasan penolakan dan dapat memperbaiki artikel mereka.

## Fitur yang Diimplementasi

### 1. Database
- Menambahkan kolom `alasan_penolakan` (TEXT, nullable) pada tabel `artikels`
- Kolom ini menyimpan alasan mengapa artikel ditolak

### 2. Admin/Guru - Menolak Artikel
- **Modal Form Penolakan**: Tombol reject sekarang membuka modal yang meminta alasan penolakan
- **Validasi**: Alasan penolakan wajib diisi (required, max 1000 karakter)
- **Notifikasi Otomatis**: Sistem otomatis membuat notifikasi untuk siswa dengan alasan penolakan
- **Log Aktivitas**: Mencatat aktivitas penolakan beserta alasannya

### 3. Siswa - Menerima Notifikasi
- **Dashboard Notifikasi**: Siswa melihat notifikasi penolakan di dashboard
- **Pesan Lengkap**: Notifikasi berisi judul artikel dan alasan penolakan
- **Badge Notifikasi**: Indikator notifikasi belum dibaca di navigation

### 4. Siswa - Melihat Alasan Penolakan
- **Dashboard**: Artikel yang ditolak menampilkan alasan penolakan dalam box merah
- **Form Edit**: Saat mengedit artikel yang ditolak, alasan penolakan ditampilkan di atas form
- **Status Visual**: Artikel ditolak memiliki styling khusus (warna merah)

### 5. Siswa - Memperbaiki Artikel
- **Tombol Perbaiki**: Artikel yang ditolak memiliki tombol "Perbaiki" 
- **Auto Reset Status**: Saat artikel diedit, status otomatis berubah dari "rejected" ke "draft"
- **Hapus Alasan**: Alasan penolakan dihapus saat artikel diperbaiki
- **Resubmit**: Siswa dapat resubmit artikel yang sudah diperbaiki

## Alur Kerja

### Penolakan Artikel:
1. Admin/Guru melihat artikel pending
2. Klik tombol "Reject" → Modal terbuka
3. Isi alasan penolakan → Submit
4. Artikel status berubah ke "rejected"
5. Notifikasi otomatis dikirim ke siswa
6. Log aktivitas tercatat

### Perbaikan Artikel:
1. Siswa melihat notifikasi penolakan
2. Buka dashboard → lihat artikel yang ditolak
3. Klik "Perbaiki" → Form edit terbuka dengan alasan penolakan
4. Edit artikel → Status otomatis ke "draft", alasan penolakan dihapus
5. Klik "Resubmit" → Status ke "pending" untuk verifikasi ulang

## File yang Dimodifikasi

### Controllers:
- `AdminController.php` - Method `rejectArtikel()` 
- `GuruController.php` - Method `rejectArtikel()`
- `SiswaController.php` - Method `updateArtikel()` dan `submitArtikel()`

### Models:
- `Artikel.php` - Menambahkan `alasan_penolakan` ke fillable

### Views:
- `admin/artikels/index.blade.php` - Modal penolakan
- `admin/artikels/show.blade.php` - Modal penolakan + tampilan alasan
- `guru/artikels/index.blade.php` - Modal penolakan  
- `guru/artikels/show.blade.php` - Modal penolakan + tampilan alasan
- `auth/dashboard.blade.php` - Tampilan alasan penolakan + tombol perbaiki
- `siswa/artikel/edit.blade.php` - Notifikasi alasan penolakan

### Database:
- Migration: `add_alasan_penolakan_to_artikels_table.php`

## Keamanan
- Validasi input alasan penolakan (required, max 1000 karakter)
- Cek kepemilikan artikel sebelum edit/submit
- CSRF protection pada semua form
- XSS protection dengan escape output

## UI/UX
- Modal yang user-friendly untuk input alasan
- Styling konsisten dengan tema aplikasi
- Notifikasi visual yang jelas untuk artikel ditolak
- Tombol aksi yang intuitif (Perbaiki, Resubmit)