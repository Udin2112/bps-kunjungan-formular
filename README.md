# BPS Kunjungan Formular

Aplikasi Buku Tamu Digital merupakan sistem berbasis website yang dikembangkan untuk mendukung proses administrasi pencatatan kunjungan di **BPS Kota Langsa**.  
Aplikasi ini hadir sebagai solusi atas pencatatan manual yang kurang efisien, dengan menyediakan formulir kunjungan online yang dapat diisi langsung oleh pengunjung.  
Data yang tercatat tersimpan otomatis dalam sistem sehingga lebih aman, terstruktur, dan mudah diakses kembali.  

Selain itu, aplikasi dilengkapi dengan berbagai fitur penting seperti **autentikasi admin**, **dashboard monitoring kunjungan secara real-time**, **riwayat dan laporan kunjungan yang dapat diekspor ke Excel/CSV**, serta **analisis dan visualisasi data dalam bentuk grafik**.  
Admin juga dapat mengelola data kunjungan maupun akun admin dengan lebih mudah.  
Dengan penerapan aplikasi ini, BPS dapat meningkatkan **efisiensi, akuntabilitas, dan transparansi pelayanan publik** sekaligus memberikan pengalaman pelayanan yang lebih cepat, modern, dan nyaman bagi setiap tamu.

<p align="center">
  <img src="https://github.com/Udin2112/bps-kunjungan-formular/blob/main/WhatsApp%20Image%202025-09-25%20at%2009.20.52%20(2).jpeg?raw=true" width="300" alt="Screenshot 1">
  <img src="https://github.com/Udin2112/bps-kunjungan-formular/blob/main/WhatsApp%20Image%202025-09-25%20at%2009.20.52.jpeg?raw=true" width="300" alt="Screenshot 2">
  <img src="https://github.com/Udin2112/bps-kunjungan-formular/blob/main/WhatsApp%20Image%202025-09-25%20at%2009.20.52%20(1).jpeg?raw=true" width="300" alt="Screenshot 3">
</p>

## Fitur
- Form input kunjungan tamu  
- Laporan dan rekap kunjungan  
- Export data ke Excel/CSV  
- Dashboard grafik kunjungan  
- Autentikasi admin dan manajemen akun  

## Instalasi
1. Clone repo  
2. Jalankan `composer install`  
3. Salin `.env.example` ke `.env` dan sesuaikan database  
4. Jalankan `php artisan key:generate`  
5. Jalankan `php artisan migrate`  
6. Jalankan `npm install` untuk mengunduh dependency frontend  
7. Jalankan `npm run dev` untuk mode pengembangan (hot reload)  
8. Jalankan `npm run build` untuk build production  
9. Jalankan `php artisan serve` untuk menjalankan server Laravel  

## Lisensi
Proyek ini menggunakan [MIT License](LICENSE).
