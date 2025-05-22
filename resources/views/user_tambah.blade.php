<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tambah User</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">
  <div class="w-full max-w-3xl bg-white p-10 rounded-lg shadow-lg">
    <h3 class="text-3xl font-semibold text-gray-700 mb-8 text-center">Tambah User</h3>

    <form action="{{ route('user.store') }}" method="POST" class="space-y-8">
      @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Username -->
        <div class="flex flex-col">
          <label for="username" class="mb-2 font-medium text-gray-700">Username</label>
          <input
            type="text"
            name="username"
            id="username"
            value="{{ old('username') }}"
            placeholder="Masukkan username"
            class="rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            required
          >
          @error('username')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <!-- Password -->
        <div class="flex flex-col">
          <label for="password" class="mb-2 font-medium text-gray-700">Password</label>
          <input
            type="password"
            name="password"
            id="password"
            placeholder="Masukkan password"
            class="rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            required
          >
          @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div class="flex flex-col">
        <label for="level" class="mb-2 font-medium text-gray-700">Level</label>
        <select
          name="level"
          id="level"
          required
          class="rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
        >
          <option value="" disabled selected>-- Pilih Level --</option>
          <option value="admin">Admin</option>
          <option value="mahasiswa">Mahasiswa</option>
        </select>
        @error('level')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Buttons -->
      <div class="flex justify-center space-x-6 mt-6">
        <button
          type="submit"
          class="flex items-center justify-center px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-200"
        >
          <i class="fas fa-save mr-2"></i> Simpan
        </button>

        <a
          href="{{ route('user.index') }}"
          class="flex items-center justify-center px-6 py-3 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition duration-200"
        >
          <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
      </div>
    </form>
  </div>
</body>
</html>
