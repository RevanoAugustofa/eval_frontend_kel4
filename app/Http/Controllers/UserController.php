<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('http://localhost:8080/user');

        if ($response->successful()) {
            $users = collect($response->json())->sortBy('id_user')->values();
            //ngambil dari nama file view nya
            return view('user', compact('users'));
        } else {
            return back()->with('error', 'Gagal mengambil data user');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user_tambah');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        $validate = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'level' => 'required'
        ]);

        // Kirim sebagai form (kalau backend kamu tidak terima JSON)
        $response = Http::asForm()->post('http://localhost:8080/user', $validate);

        if (!$response->successful()) {
            return back()->with('error', 'Gagal menambah user. Status: ' . $response->status() . '. Pesan: ' . $response->body());
        }

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    } catch (\Exception $e) {
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }

        // try {
        //     $validate = $request->validate([
        //         'username' => 'required',
        //         'password' => 'required',
        //         'level' => 'required'
        //     ]);

            // Enkripsi password jika perlu
            // $validate['password'] = Hash::make($validate['password']);
            // tadinya seperti ini karena ga pake json
            // $response = Http::post('http://localhost:8080/user', $validate);

    //         // Tambahkan ini untuk mengetahui apa yang terjadi
    //         if (!$response->successful()) {
    //             return back()->with('error', 'Gagal menambah user. Status: ' . $response->status() . '. Pesan: ' . $response->body());
    //         }

    //         return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    //     }
    }


    /**
     * Display the specified resource.
     */
    public function show($mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $res = Http::get("http://localhost:8080/user/$id");

        if (!$res->successful()) {
            return back()->with('error', 'Data user tidak ditemukan.');
        }

        $user = $res->json();
        return view('user_edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validate = $request->validate([
                'username' => 'required',
                'password' => 'nullable',
                'level' => 'required'
            ]);

            // Jika password tidak kosong, enkripsi. Jika kosong, jangan kirim.
            if (!empty($validate['password'])) {
                $validate['password'] = Hash::make($validate['password']);
            } else {
                unset($validate['password']);
            }

            Http::asForm()->put("http://localhost:8080/user/$id", $validate);

            return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Http::delete("http://localhost:8080/user/$id");
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}
