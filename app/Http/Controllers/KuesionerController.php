<?php

namespace App\Http\Controllers;

// Impor kelas-kelas yang dibutuhkan
use Illuminate\Http\Request;
use App\Models\Respondent;
use Illuminate\Support\Facades\DB; // <-- TAMBAHKAN INI
use App\Models\Petugas; // <-- Jangan lupa impor Petugas
use Illuminate\Support\Str;


class KuesionerController extends Controller
{
    /**
     * Menampilkan halaman beranda.
     */
    public function beranda()
    {
        return view('beranda');
    }

    /**
     * Menampilkan halaman formulir yang kosong dan statis.
     * Ini adalah method yang dipanggil oleh route 'kuesioner.form'.
     */
    // Method ini untuk menampilkan formulir
    public function showForm()
    {
        // Ambil semua data petugas dari database
        $petugas = Petugas::all();

        // Kirim data petugas ke view formulir
        return view('survei.formulir', compact('petugas'));
    }

    /**
     * Memvalidasi dan menyimpan data survei yang disubmit.
     */
    public function store(Request $request)
    {
        // dd($request->all()); // <-- TAMBAHKAN INI DI BARIS PERTAMA
        // dd(DB::table('pendidikans')->get()); // <-- GANTI dd() SEBELUMNYA DENGAN INI


        // 1. Validasi data yang masuk (kode ini sudah benar)
        $validatedData = $request->validate([
            // Blok Penilaian Petugas
            'petugas_id' => 'present|nullable|string',
            'petugas_lainnya_nama' => 'required_if:petugas_id,lainnya|nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'kritik_saran' => 'nullable|string',
            // Blok Data Responden (sesuaikan dengan field)
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'pendidikan_id' => 'required',
            'pekerjaan_id' => 'required',
            'instansi_id' => 'required',
            'pemanfaatan_id' => 'required',
            'jenis_layanan' => 'required|array',
            'sarana_digunakan' => 'required|array',
            'pernah_pengaduan' => 'required|string',
            'penilaian' => 'required|array',
            'kebutuhan_data_json' => 'nullable|json',
            'nama_instansi' => 'required|string',
            'pekerjaan_lainnya' => 'nullable|string',
            'instansi_lainnya' => 'nullable|string',
            'pemanfaatan_lainnya' => 'nullable|string',
            'sarana_lainnya' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        // 2. Siapkan data untuk disimpan
        $dataToCreate = $validatedData;
        
        if (empty($request->input('petugas_id')) || $request->input('petugas_id') === 'lainnya') {
            $dataToCreate['petugas_id'] = null;
        }

        // [BAGIAN PENTING YANG HILANG]
        // Ubah nama field dan decode JSON sebelum menyimpan
        $dataToCreate['kebutuhan_data'] = json_decode($validatedData['kebutuhan_data_json'], true);
        unset($dataToCreate['kebutuhan_data_json']);

        $dataToCreate['unique_token'] = Str::uuid();

        // dd($dataToCreate);

        // 3. Simpan ke database
        Respondent::create($dataToCreate);

        // 4. Arahkan ke halaman sukses
        return redirect()->route('kuesioner.success')->with('status', 'Terima kasih telah mengisi survei!');

    }

    /**
     * Menampilkan halaman sukses "sekali pakai".
     */
    public function showSuccess()
    {
        // Cek apakah ada "pesan titipan" dari method store.
        if (!session('status')) {
            // Jika tidak ada (artinya pengguna me-refresh atau akses langsung),
            // usir mereka ke halaman formulir baru yang kosong.
            return redirect()->route('kuesioner.form');
        }

        // Jika ada, tampilkan halaman sukses. Pesan akan otomatis terhapus.
        return view('survei.success');
    }

    /**
     * Menampilkan formulir untuk mengedit data yang sudah ada.
     */
    public function edit(Respondent $respondent)
    {
        // Kirim juga daftar petugas ke view edit agar tidak error
        $petugas = Petugas::orderBy('nama', 'asc')->get();
        return view('survei.formulir', compact('respondent', 'petugas'));
    }

    /**
     * [METHOD BARU]
     * Mengupdate data responden yang sudah ada di database.
     */
    public function update(Request $request, Respondent $respondent)
    {
        // 1. Validasi data yang masuk (sama seperti di method store)
        $validatedData = $request->validate([
            'petugas_id' => 'present|nullable|string',
            'petugas_lainnya_nama' => 'required_if:petugas_id,lainnya|nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'kritik_saran' => 'nullable|string',

            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'pendidikan_id' => 'required',
            'pekerjaan_id' => 'required',
            'instansi_id' => 'required',
            'pemanfaatan_id' => 'required',
            'jenis_layanan' => 'required|array',
            'sarana_digunakan' => 'required|array',
            'pernah_pengaduan' => 'required|string',
            'penilaian' => 'required|array',
            'kebutuhan_data_json' => 'nullable|json',
            'nama_instansi' => 'required|string',
            'pekerjaan_lainnya' => 'nullable|string',
            'instansi_lainnya' => 'nullable|string',
            'pemanfaatan_lainnya' => 'nullable|string',
            'sarana_lainnya' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        $updateData = $validatedData;
    
        // Logika untuk menangani petugas_id (sama seperti di store)
        if (empty($request->input('petugas_id')) || $request->input('petugas_id') === 'lainnya') {
            $updateData['petugas_id'] = null;
        }

        // Logika untuk kebutuhan_data_json (sama seperti di store)
        $updateData['kebutuhan_data'] = json_decode($validatedData['kebutuhan_data_json'], true);
        unset($updateData['kebutuhan_data_json']);

        // Buat token baru agar link edit lama tidak bisa dipakai lagi
        $updateData['unique_token'] = Str::uuid();

        $updateData['status'] = 'pending';

        $respondent->update($updateData);

        return redirect()->route('kuesioner.success')->with('status', 'Data Anda telah berhasil diperbarui. Terima kasih!');
    }
}
