# Cara menjalankan proyek ini
1. Pastikan Anda memiliki Node.js dan npm (Node Package Manager) terinstal di sistem Anda.
2. Clone repositori ini ke komputer Anda menggunakan perintah:
   ```
   git clone <URL_REPOSITORI>
   ```
3. Masuk ke direktori proyek:
   ```
   cd <NAMA_DIREKTORI_PROYEK>
   ```
4. Instal dependensi proyek dengan menjalankan perintah:
   ```
   npm install
   ``` 
5. Setelah semua dependensi terinstal, jalankan proyek dengan perintah:
   ```
   npm start
   ```

# Cara test fitur login
1. Jalankan perintah php artisan serve untuk menjalankan server lokal.
2. Buka browser dan akses URL: http://localhost:8000/login.
3. Masukkan email dan password yang valid untuk login:
    - Email: admin@example.com, pengunjung@example.com, pembeli@example.com, penjual@example.com
    - Password: password123

# Cara test fitur role management
1. Pastikan Anda sudah login sebagai pengguna selain admin.
2. Akses halaman role management melalui URL: http://localhost:8000/admin/dashboard.
3. Jika anda tidak memiliki hak akses, Anda akan diarahkan ke halaman error.