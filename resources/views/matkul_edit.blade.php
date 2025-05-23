<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Mata Kuliah</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">
  <div class="w-full max-w-3xl bg-white p-10 rounded-lg shadow-lg">
    <h3 class="text-3xl font-semibold text-gray-700 mb-8 text-center">Edit Mata Kuliah</h3>

    <form action="{{ route('matkul.update', $matkul['kode_matkul']) }}" method="POST" class="space-y-8">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Kode Matakuliah -->
        <div class="flex flex-col">
          <label for="kode_matkul" class="mb-2 font-medium text-gray-700">Kode Matakuliah</label>
          <input 
            type="text" 
            name="kode_matkul" 
            id="kode_matkul" 
            value="{{ old('kode_matkul', $matkul['kode_matkul']) }}" 
            readonly
            class="rounded-md border border-gray-300 px-4 py-2 shadow-sm bg-gray-100  focus:outline-none">
        </div>

        <!-- Nama Matakuliah -->
        <div class="flex flex-col">
          <label for="nama_matkul" class="mb-2 font-medium text-gray-700">Nama Matakuliah</label>
          <input 
            type="text" 
            name="nama_matkul" 
            id="nama_matkul" 
            value="{{ old('nama_matkul', $matkul['nama_matkul']) }}" 
            required
            class="rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
          >
          @error('nama_matkul')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <!-- SKS -->
        <div class="md:col-span-2 flex flex-col">
          <label for="sks" class="mb-2 font-medium text-gray-700">SKS</label>
          <input 
            type="number" 
            name="sks" 
            id="sks"
            value="{{ old('sks', $matkul['sks']) }}" 
            {{-- placeholder="Isi jika ingin mengganti sks"  --}}
            class="rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
          >
          @error('sks')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div class="flex justify-center space-x-6 mt-6">
        <button 
          type="submit" 
          class="flex items-center justify-center px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-200">
          <i class="fas fa-save mr-2"></i> Update
        </button>

        <a 
          href="{{ route('matkul.index') }}" 
          class="flex items-center justify-center px-6 py-3 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition duration-200">
          <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
      </div>
    </form>
  </div>
</body>
</html>
