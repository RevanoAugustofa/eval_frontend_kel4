📘 Evaluasi Proyek Kelompok 4 – Frontend Laravel & Backend CodeIgniter
## 📦 Prasyarat
- PHP >= 8.1
- Composer
- Node.js & NPM
- Laravel 11.x
- MySQL

## Langkah 1: Clone Repository Backend CodeIgniter
1. Buka terminal (cmd atau terminal di VS Code).
3. Arahkan ke folder Laragon www (biasanya C:\laragon\www):
```
cd C:\laragon\www
```
5. Clone repository backend:
```
git clone https://github.com/NalindraDT/Simon-kehadiran
```
7. jalankan
 ```
composer install
```
9. Masuk ke folder backend hasil clone:
```
cd backend
```

## Langkah 2: Konfigurasi Database dan Koneksi Frontend ke Backend
### 3.1. Database
- Download database dari repository berikut ``` https://github.com/JiRizkyCahyusna/DBE_Simon ```
- Buka phpMyAdmin melalui Laragon.
- Buat database baru dengan nama cuti.
- Import database yang sudah didownload.
### 3.2. Koneksi API Backend (CI)
Sebelum frontend Laravel mengakses backend, pastikan API dari backend CodeIgniter berjalan dengan baik. Untuk itu, lakukan pengujian menggunakan Postman:

Jalankan backend CodeIgniter:
```
php spark serve
```
Buat request baru di aplikasi Postman:

GET ``` http://localhost:8080/user ```

POST ``` http://localhost:8080/user/{id}```

PUT ``` http://localhost:8080/user/{id} ```

DELETE ``` http://localhost:8080/user/{id} ```

## Langkah 4: Membuat Project Laravel Frontend
### 4.1 Membuat Laravel dengan Laragon Quick App
- Buka Laragon.
- Klik kanan kemudian klik menu Quick app > pilih Laravel.
- Masukkan nama project frontend, contoh frontend.
- Klik Create dan tunggu proses pembuatan project selesai.
### 4.2 Membuat Tampilan
1. Salin & edit file .env
- Salin file ``` .env.example``` menjadi ``` .env ```
```
cp .env.example .env
```
- Ubah nilai SESSION_DRIVER menjadi:
```
SESSION_DRIVER=file
```
2. Buat controller user
```
php artisan make:controller UserController
```
Edit ```app/Http/Controllers/UserController.php``` seperti ini:
```php
<?php
 
 namespace App\Http\Controllers;
 
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Http;
 
 class UserController extends Controller
 {
     // Tampilkan data user dari API
     public function index()
     {
         $response = Http::get('http://localhost:8080/user');
 
         if ($response->successful()) {
             $user = $response->json();
             return view('tampil_user', ['user' => $user]);
         }
 
         return back()->with('error', 'Gagal mengambil data user dari API');
     }
 
     public function create()
     {
         $response = Http::get('http://localhost:8080/user'); 
 
         if ($response->successful()) {
             $user = $response->json();
             return view('tambah_user', compact('user'));
         }
         return view('tambah_user', ['user' => []])->withErrors(['msg' => 'Gagal mengambil data user']);
     }
 
     // Simpan data user baru lewat API
     public function store(Request $request)
     {
         $request->validate([
             'password' => 'required|string',
             'username' => 'required|string',
             'level' => 'required|string',
         ]);
 
         $response = Http::asForm()->post('http://localhost:8080/user', $request->only('password', 'username', 'level'));
 
         if ($response->successful()) {
             return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan');
         }
 
         return back()->with('error', 'Gagal menambahkan data user');
     }
 
     public function edit($id_user)
     {
         // Ambil data user berdasarkan ID User
         $response = Http::get("http://localhost:8080/user/{$id_user}");
 
         // Cek apakah kedua response berhasil
         if ($response->successful()) {
             $user = $response->json()[0];
             return view('edit_user', compact('user'));
         }
         return redirect()->back()->withErrors(['msg' => 'Gagal mengambil data user']);
     }
 
 
     // Update data user lewat API
     public function update(Request $request, $id_user)
     {
         $request->validate([
             'password' => 'required|string',
             'username' => 'required|string',
             'level' => 'required|string',
         ]);
 
         $response = Http::asForm()->put("http://localhost:8080/user/{$id_user}", $request->only('password', 'username', 'level'));
 
         if ($response->successful()) {
             return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui');
         }
 
         return back()->with('error', 'Gagal memperbarui data user');
     }
 
     // Hapus data user lewat API
     public function destroy($id_user)
     {
         $response = Http::delete("http://localhost:8080/user/{$id_user}");
 
         if ($response->successful()) {
             return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus');
         }
 
         return back()->with('error', 'Gagal menghapus data user');
     }
 
 
 }
```
3. Buat view user
```
php artisan make:view User
```
Buat ```Resources/Views/user.blade.php```

```html
<!DOCTYPE html>
 <html lang="en">
 
 <head>
     <meta charset="UTF-8">
     <title>Data User</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <script src="https://cdn.tailwindcss.com"></script>
     <script src="https://unpkg.com/feather-icons"></script>
 </head>
 
 <body class="bg-gray-100 text-gray-900">
 
     <div class="flex min-h-screen">
         <!-- Sidebar -->
         <aside class="w-64 bg-white shadow-md p-6 space-y-4">
             <h2 class="text-2xl font-bold text-blue-600 mb-6">SiCuti</h2>
             <nav class="space-y-4">
                 <a href="{{ route('homepage') }}" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600 font-medium">
                     <i data-feather="home" class="w-5 h-5"></i>
                     <span>Dashboard</span>
                 </a>
                 <a href="{{ route('user.index') }}" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600 font-medium">
                     <i data-feather="user-check" class="w-5 h-5"></i>
                     <span>Data User</span>
                 </a>
                 <a href=".." class="flex items-center space-x-3 text-gray-700 hover:text-blue-600 font-medium">
                     <i data-feather="shield" class="w-5 h-5"></i>
                     <span>Data Kajur</span>
                 </a>
                 <a href=".." class="flex items-center space-x-3 text-gray-700 hover:text-blue-600 font-medium">
                     <i data-feather="users" class="w-5 h-5"></i>
                     <span>Data Mahasiswa</span>
                 </a>
                 <a href=".." class="flex items-center space-x-3 text-gray-700 hover:text-blue-600 font-medium">
                     <i data-feather="calendar" class="w-5 h-5"></i>
                     <span>Data Cuti</span>
                 </a>
             </nav>
         </aside>
 
         <!-- Main Content -->
         <main class="flex-1 p-8">
             <div class="flex justify-between items-center mb-6">
                 <h1 class="text-3xl font-bold">Data User</h1>
                 <a href="{{ route('user.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center space-x-2">
                     <i data-feather="plus" class="w-4 h-4"></i>
                     <span>Tambah User</span>
                 </a>
             </div>
 
             <!-- Tabel Data Dosen -->
             <div class="bg-white rounded-lg shadow overflow-x-auto">
                 <table class="min-w-full table-auto text-left text-gray-900">
                     <thead class="bg-gray-100">
                         <tr>
                             <th class="px-6 py-3">ID User</th>
                             <th class="px-6 py-3">Password</th>
                             <th class="px-6 py-3">Username</th>
                             <th class="px-6 py-3">Level</th>
                             <th class="px-6 py-3">Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($user as $usr)
                         <tr class="border-t">
                             <td class="px-6 py-3">{{ $usr['id_user'] }}</td>
                             <td class="px-6 py-3">{{ $usr['password'] }}</td>
                             <td class="px-6 py-3">{{ $usr['username'] }}</td>
                             <td class="px-6 py-3">{{ $usr['level'] }}</td>
                             <td class="px-6 py-3 space-x-2">
                                 <a href="{{ url('/user/' . $usr['id_user'] . '/edit') }}" class="text-blue-600 hover:underline flex items-center space-x-1 inline-flex">
                                     <i data-feather="edit" class="w-4 h-4"></i><span>Edit</span>
                                 </a>
                                 <form action="{{ route('user.destroy', $usr['id_user']) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')" class="inline">
                                     @csrf
                                     @method('DELETE')
                                     <button type="submit" class="text-red-600 hover:underline flex items-center space-x-1">
                                         <i data-feather="trash-2" class="w-4 h-4"></i><span>Hapus</span>
                                     </button>
                                 </form>
                             </td>
                         </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
         </main>
     </div>
 
     <script>
         feather.replace();
     </script>
 
 </body>
 
 </html>
```

4. Buka routes/web.php dan tambahkan menjadi:
```php
<?php
 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\UserController;

 Route::get('/', function () {
     return view('homepage');
 })->name('homepage');

 Route::resource('user', UserController::class);
```
Jalankan Laravel
```
composer instal
```
Kemudian
```
php artisan serve
```
Membuat Controller bisa pake ini
```
php artisan make:model nama_controller -mcr
```
