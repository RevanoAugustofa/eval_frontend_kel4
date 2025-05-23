<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tambah Mata Kuliah</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">

  <div class="w-full max-w-3xl bg-white p-10 rounded-lg shadow-lg">
    <h3 class="text-3xl font-semibold text-gray-700 mb-8 text-center">Tambah Mata Kuliah</h3>

    <form action="{{ route('matkul.store') }}" method="POST" class="space-y-6">
      @csrf

      <!-- input -->
      <div class="">
        <!-- Kode Matkul -->
        <div>
          <label for="kode_matkul" class="block mb-2 font-medium text-gray-700">Kode Matkul</label>
          <input
            type="text"
            name="kode_matkul"
            id="kode_matkul"
            value="{{ old('kode_matkul') }}"
            placeholder="Masukkan kode matkul"
            class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            required
          >
          @error('kode_matkul')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Nama Matkul -->
        <div>
          <label for="nama_matkul" class="block mb-2 font-medium text-gray-700">Nama Matkul</label>
          <input
            type="text"
            name="nama_matkul"
            id="nama_matkul"
            value="{{ old('nama_matkul') }}"
            placeholder="Masukkan nama matkul"
            class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            required
          >
          @error('nama_matkul')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <!-- SKS -->
      <div>
        <label for="sks" class="block mb-2 font-medium text-gray-700">SKS</label>
        <input
          type="number"
          name="sks"
          id="sks"
          value="{{ old('sks') }}"
          placeholder="Masukkan SKS"
          class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none"
          required
        >
        @error('sks')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Tombol Aksi -->
      <div class="flex justify-center space-x-4 pt-4">
        <button
          type="submit"
          class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition"
        >
          Simpan
        </button>
        <a
          href="{{ route('matkul.index') }}"
          class="bg-gray-600 text-white px-6 py-2 rounded-md hover:bg-gray-700 transition"
        >
          Kembali
        </a>
      </div>
    </form>
  </div>

</body>
</html>
