<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard User</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css"></script>
  
</head>
<body class="bg-gray-100 text-gray-900">

  <!-- Navbar -->
  <header class="bg-white shadow-md fixed top-0 left-0 right-0 z-10">
    <div class="max-w-full mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-xl font-bold">Dashboard</h1>
      <div class="flex items-center space-x-4">
        <span class="text-gray-600">Hello, Admin</span>
        <a href="" class="rounded-full w-8 h-8 bg-blue-500"></a>
      </div>
    </div>
  </header>

  <div class="flex pt-16 min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 p-6 fixed h-full">
      <nav class="space-y-4">
        <a href="{{ route('dashboard.user') }}" class="block px-4 py-2 rounded bg-gray-200 font-medium text-blue-800">Users</a>
        <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100 font-medium text-gray-800">Mahasiswa</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 flex-1 p-6 bg-gray-100">
      <h2 class="text-2xl font-bold mb-6">Data Users</h2>

      <button class="bg-green-500 text-white m-2 p-3 rounded px-6">Tambah</button>
      <div class="overflow-x-auto bg-white shadow rounded-lg">
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
          <tbody class="divide-y divide-gray-200 bg-white ">
            @foreach($users as $user)
            <tr>
              {{-- tadinya itu kaya gini
              kalo kaya gini tuh katanya array to array
              $user->id_user --}}

              {{-- mengambil dari database... menyesuaikan databasenya --}}
              <td class="px-6 py-4">{{ $user['id_user'] }}</td>
              <td class="px-6 py-4">{{ $user['username'] }}</td>
              <td class="px-6 py-4">{{ $user['password'] }}</td>  
              <td class="px-6 py-4">{{ $user['level'] }}</td>

              {{-- AKSI --}}
              <td class="px-6 py-4">

                <a href="{{ Route('user.edit', $d['id_user']) }" class="bg-blue-400 text-white rounded p-2">Edit</a>


                {{-- FORM DELETE --}}
                {{-- $user itu dari foreach. dan id user itu dari data nya di database...  --}}
                <form action="{{Route( 'user.destroy',$user['id_user']) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-red-700 text-white rounded p-2">Hapus</button> 
              </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </main>
  </div>

</body>
</html>
