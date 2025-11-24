# Update Laporan Artikel

## Perubahan yang Dilakukan

### 1. Controller (AdminController.php)
- **Method `laporan()`**: Mengubah query dari hanya `published` menjadi `whereIn(['published', 'rejected'])`
- **Method `generatePDF()`**: Mengubah query dari hanya `published` menjadi `whereIn(['published', 'rejected'])`

### 2. View Laporan Web (admin/laporan/index.blade.php)
- **Statistik Cards**: Menambahkan 3 card statistik:
  - Artikel Diterbitkan (hijau)
  - Artikel Ditolak (merah) 
  - Total Artikel (biru)
- **Tabel**: Menambahkan kolom "Status" untuk membedakan artikel diterbitkan vs ditolak
- **Alasan Penolakan**: Menampilkan baris tambahan dengan alasan penolakan untuk artikel yang ditolak
- **Styling**: Badge status dengan warna berbeda (hijau untuk diterbitkan, merah untuk ditolak)

### 3. View PDF (admin/laporan/pdf.blade.php)
- **Header**: Mengubah judul dari "Artikel yang Telah Dipublikasikan" menjadi "Artikel yang Diterbitkan dan Ditolak"
- **Tabel**: Menambahkan kolom "Status" 
- **Alasan Penolakan**: Menampilkan baris tambahan dengan background merah muda untuk alasan penolakan
- **Ringkasan**: Menampilkan statistik terpisah:
  - Total Artikel Diterbitkan
  - Total Artikel Ditolak
  - Total Keseluruhan

## Fitur Baru

### Statistik Lengkap
- Dashboard laporan sekarang menampilkan breakdown artikel berdasarkan status
- PDF laporan mencakup ringkasan statistik yang lebih detail

### Informasi Penolakan
- Alasan penolakan ditampilkan langsung di laporan
- Styling khusus untuk membedakan artikel yang ditolak
- Informasi lengkap untuk analisis dan evaluasi

### Manfaat
- **Admin/Guru**: Dapat melihat overview lengkap semua artikel dan alasan penolakan
- **Evaluasi**: Membantu mengidentifikasi pola penolakan artikel
- **Transparansi**: Dokumentasi lengkap keputusan editorial
- **Analisis**: Data untuk perbaikan kualitas artikel di masa depan

## Tampilan Laporan

### Web Interface:
- Cards statistik di bagian atas
- Tabel dengan kolom status dan alasan penolakan
- Styling responsif dan user-friendly

### PDF Export:
- Format profesional untuk dokumentasi
- Statistik ringkasan di bagian bawah
- Alasan penolakan terintegrasi dalam tabel
- Informasi tanggal cetak dan periode