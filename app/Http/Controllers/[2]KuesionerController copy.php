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
            'kebutuhan_data_json' => 'required|json',
            'nama_instansi' => 'required|string',
            'pekerjaan_lainnya' => 'nullable|string',
            'instansi_lainnya' => 'nullable|string',
            'pemanfaatan_lainnya' => 'nullable|string',
            'sarana_lainnya' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        // Siapkan data untuk disimpan
        $dataToCreate = $validatedData;
        
        // Atur petugas_id menjadi NULL jika user memilih 'lainnya' atau 'tidak ingat'
        if ($request->input('petugas_id') === 'lainnya' || empty($request->input('petugas_id'))) {
            $dataToCreate['petugas_id'] = null;
        }

        $dataToCreate['unique_token'] = Str::uuid();

        // Simpan semua data ke database
        Respondent::create($dataToCreate);

        // Arahkan ke halaman sukses
        return redirect()->route('kuesioner.success')->with('status', 'Terima kasih telah mengisi survei!');

        // $validatedData['unique_token'] = Str::uuid(); // Tambahkan ini sebelum create()

        // 2. Simpan ke Database (tanpa unique_token)
        // Respondent::create([
        //     'nama' => $validatedData['nama'],
        //     'email' => $validatedData['email'],
        //     'no_hp' => $validatedData['no_hp'],
        //     'jenis_kelamin' => $validatedData['jenis_kelamin'],
        //     'pendidikan_id' => $validatedData['pendidikan_id'],
        //     'pekerjaan_id' => $validatedData['pekerjaan_id'],
        //     'instansi_id' => $validatedData['instansi_id'],
        //     'pemanfaatan_id' => $validatedData['pemanfaatan_id'],
        //     'pekerjaan_lainnya' => $validatedData['pekerjaan_lainnya'],
        //     'instansi_lainnya' => $validatedData['instansi_lainnya'],
        //     'pemanfaatan_lainnya' => $validatedData['pemanfaatan_lainnya'],
        //     'nama_instansi' => $validatedData['nama_instansi'],
        //     'jenis_layanan' => $validatedData['jenis_layanan'],
        //     'sarana_digunakan' => $validatedData['sarana_digunakan'],
        //     'sarana_lainnya' => $validatedData['sarana_lainnya'],
        //     'pernah_pengaduan' => $validatedData['pernah_pengaduan'],
        //     'penilaian' => $validatedData['penilaian'],
        //     'kebutuhan_data' => json_decode($validatedData['kebutuhan_data_json']),
        //     'catatan' => $validatedData['catatan'],
        //     'unique_token' => $validatedData['unique_token'],
        // ]);

        // // 3. Arahkan ke halaman sukses dengan "pesan titipan"
        // return redirect()->route('kuesioner.success')->with('status', 'Survei Berhasil Dikirim!');
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
        // Bagian 'compact('respondent')' inilah yang mengirim data ke view
        return view('survei.formulir', compact('respondent'));
    }

    /**
     * [METHOD BARU]
     * Mengupdate data responden yang sudah ada di database.
     */
    public function update(Request $request, Respondent $respondent)
    {
        // 1. Validasi data yang masuk (sama seperti di method store)
        $validatedData = $request->validate([
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
            'kebutuhan_data_json' => 'required|json',
            'nama_instansi' => 'required|string',
            'pekerjaan_lainnya' => 'nullable|string',
            'instansi_lainnya' => 'nullable|string',
            'pemanfaatan_lainnya' => 'nullable|string',
            'sarana_lainnya' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        $updateData = $validatedData;
        $validatedData['unique_token'] = Str::uuid(); // Tambahkan ini sebelum create()
          
        // 2) Decode JSON ke array dan assign ke kolom yang benar
        $updateData['kebutuhan_data'] = json_decode($validatedData['kebutuhan_data_json'], true);
        unset($updateData['kebutuhan_data_json']);

        // 3) Regenerate token supaya link lama gak bisa dipakai lagi
        $updateData['unique_token'] = Str::uuid();

        // 4) Update model (mass assignment)
        $respondent->update($updateData);

        // 5) Redirect ke form baru
        return redirect()
        ->route('kuesioner.success')
        ->with('status', 'Data Anda telah berhasil diperbarui. Terima kasih!');
    }
}
