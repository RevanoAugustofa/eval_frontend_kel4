<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $response = Http::get('http://localhost:8080/matkul');

        if ($response->successful()) {
            $matkuls = collect($response->json())->sortBy('kode_matkul')->values();
            //ngambil dari nama file view nya
            return view('matkul', compact('matkuls'));
        } else {
            return back()->with('error', 'Gagal mengambil data matkul');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('matkul_tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        $validate = $request->validate([
            'kode_matkul' => 'required',
            'nama_matkul' => 'required',
            'sks' => 'required'
        ]);

        // Kirim sebagai form (kalau backend kamu tidak terima JSON)
        $response = Http::asForm()->post('http://localhost:8080/matkul', $validate);

        if (!$response->successful()) {
            return back()->with('error', 'Gagal menambah matkul. Status: ' . $response->status() . '. Pesan: ' . $response->body());
        }

        return redirect()->route('matkul.index')->with('success', 'Matkul berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($matkul)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kode_matkul)
    {
        $res = Http::get("http://localhost:8080/matkul/$kode_matkul");

        if (!$res->successful()) {
            return back()->with('error', 'Data Matkul tidak ditemukan.');
        }

        $matkul= $res->json();
        return view('matkul_edit', compact('matkul'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kode_matkul)
    {
        try {
            $validate = $request->validate([
                'kode_matkul' => 'required',
                'nama_matkul' => 'required',
                'sks' => 'required'
            ]);

            Http::put("http://localhost:8080/matkul/$kode_matkul", $validate);

            return redirect()->route('matkul.index')->with('success', 'Matkul berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kode_matkul)
    {
        Http::delete("http://localhost:8080/matkul/$kode_matkul");
        return redirect()->route('matkul.index')->with('success', 'Matkul berhasil dihapus!');
    }
}
