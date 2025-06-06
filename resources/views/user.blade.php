<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard User</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- DataTables CSS CDN -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <!-- jQuery (required for DataTables) -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <!-- DataTables JS CDN -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-900">

  <!-- Navbar -->
  <header class="bg-white shadow-md fixed top-0 left-0 right-0 z-10">
    <div class="max-w-full mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-xl font-bold">Dashboard</h1>
      <div class="flex items-center space-x-4">
        <span class="text-gray-600">Hello, Admin</span>
        <a class="rounded-full w-8 h-8 bg-blue-500"></a>
      </div>
    </div>
  </header>

  <div class="flex pt-16 min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-700 border-r border-gray-200 p-6 fixed h-full">
      <nav class="space-y-4">
        <a href="{{ route('dashboard.user')}}" class="block px-4 py-2 rounded bg-gray-500 font-medium text-white">User</a>
        <a href="matkul" class="block px-4 py-2 rounded hover:bg-gray-600 font-medium text-white">Mata kuliah</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 flex-1 p-6 bg-gray-100">
      <h2 class="text-2xl font-bold mb-6 border-b-2 pb-3">Data User</h2>

      <a href="{{ route('user.tambah') }}" class="bg-green-500 text-white mb-4 p-3 rounded px-6 inline-block">
        Tambah
      </a>

      <div class="overflow-x-auto bg-white shadow rounded-lg p-4">
        <table id="myTable" class="display w-full">
          <thead class="bg-gray-200 text-gray-700">
            <tr>
              <th class="px-6 py-3">ID</th>
              <th class="px-6 py-3">Username</th>
              <th class="px-6 py-3">Password</th>
              <th class="px-6 py-3">Level</th>
              <th class="px-6 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 bg-white">
            @foreach($users as $user)
            <tr>
              <td class="px-6 py-4">{{ $user['id_user'] }}</td>
              <td class="px-6 py-4">{{ $user['username'] }}</td>
              <td class="px-6 py-4">{{ $user['password'] }}</td>  
              <td class="px-6 py-4">{{ $user['level'] }}</td>
              <td class="px-6 py-4">
                <div class="flex space-x-2">
                  <a href="{{ Route('user.edit', $user['id_user']) }}" class="bg-blue-500 text-white rounded px-3 py-1 hover:bg-blue-600">
                    Edit
                  </a>
                  <form action="{{ Route('user.destroy', $user['id_user']) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white rounded px-3 py-1 hover:bg-red-700">
                      Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </main>
  </div>

  <!-- Inisialisasi DataTable -->
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable({
        responsive: true,
        language: {
          search: "Cari:",
          lengthMenu: "Tampilkan _MENU_ data per halaman",
          zeroRecords: "Data tidak ditemukan",
          info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
          infoEmpty: "Tidak ada data",
          infoFiltered: "(difilter dari total _MAX_ data)",
        }
      });
    });
  </script>

</body>
</html>
