<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use App\Models\CalonSiswa;
use App\Models\JalurRegistrasi;
use App\Models\DataRegistrasi;
use App\Models\DataTes;
use App\Models\User;
use App\Models\JadwalTes;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TabDetailSiswa extends Component
{
    public $id_calon_siswa;
    public $siswa;
    public $nama_lengkap, $nik, $nisn, $no_telp, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $npsn, $sekolah_asal, $status_sekolah, $alamat_domisili, $alamat_kk, $provinsi, $kota, $id_jalur;
    public $name, $email, $password;
    public $jadwalTesBQ, $jadwalTesJapres;
    public $jalurOptions;
    public $urlPasFoto;
    public $previewUrlKartuPeserta;
    public $previewUrlSuratKeterangan;
    public $showModalKartuPeserta = false;
    public $showModalSuratKeterangan = false;

    protected $rules = [
        'nama_lengkap' => 'required|string|max:255',
        'nik' => 'nullable|string|max:16',
        'nisn' => 'nullable|string|max:10',
        'no_telp' => 'nullable|string|max:15',
        'jenis_kelamin' => 'required|in:L,P',
        'tempat_lahir' => 'nullable|string|max:255',
        'tanggal_lahir' => 'nullable|date',
        'npsn' => 'nullable|string|max:8',
        'sekolah_asal' => 'nullable|string|max:255',
        'status_sekolah' => 'nullable|string|max:255',
        'alamat_domisili' => 'nullable|string|max:255',
        'alamat_kk' => 'nullable|string|max:255',
        'provinsi' => 'nullable|string|max:255',
        'kota' => 'nullable|string|max:255',
        'id_jalur' => 'required|exists:jalur_registrasi,id_jalur',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|string|min:8',
        'jadwalTesBQ' => 'nullable|integer',
        'jadwalTesJapres' => 'nullable|integer',
    ];

    public function mount(CalonSiswa $siswa)
    {
        $this->siswa = $siswa;
        $this->id_calon_siswa = $siswa->id_calon_siswa;
        $this->nama_lengkap = ucwords($siswa->nama_lengkap);
        $this->nik = $siswa->NIK;
        $this->nisn = $siswa->NISN;
        $this->no_telp = $siswa->no_telp;
        $this->jenis_kelamin = $siswa->jenis_kelamin;
        $this->tempat_lahir = strtoupper($siswa->tempat_lahir);
        $this->tanggal_lahir = $siswa->tanggal_lahir;
        $this->npsn = $siswa->NPSN;
        $this->sekolah_asal = strtoupper($siswa->sekolah_asal);
        $this->status_sekolah = strtoupper($siswa->status_sekolah);
        $this->alamat_domisili = ucwords($siswa->alamat_domisili);
        $this->alamat_kk = ucwords($siswa->alamat_kk);
        $this->provinsi = $siswa->provinsi;
        $this->kota = $siswa->kota;
        $this->id_jalur = $siswa->dataRegistrasi->jalur->id_jalur ?? ""; // Default to empty string if null
        $this->jalurOptions = JalurRegistrasi::all();
        $user = $siswa->user;
        $this->name = $user->name;
        $this->email = $user->email;

        $jadwalTes = $siswa->dataRegistrasi->dataTes()
            ->with('jadwalTes')
            ->orderBy('id_registrasi')
            ->get();

        $this->jadwalTesBQ = $jadwalTes->first()?->id_jadwal_tes;
        $this->jadwalTesJapres = $jadwalTes->skip(1)->first()?->id_jadwal_tes;
    }

    public function updateSiswa()
    {
        $this->validate();

        CalonSiswa::where('id_calon_siswa', $this->id_calon_siswa)->update([
            'nama_lengkap' => strtolower($this->nama_lengkap),
            'NIK' => $this->nik,
            'NISN' => $this->nisn,
            'no_telp' => $this->no_telp,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => strtolower($this->tempat_lahir),
            'tanggal_lahir' => $this->tanggal_lahir,
            'NPSN' => $this->npsn,
            'sekolah_asal' => strtolower($this->sekolah_asal),
            'status_sekolah' => strtolower($this->status_sekolah),
            'alamat_domisili' => strtolower($this->alamat_domisili),
            'alamat_kk' => strtolower($this->alamat_kk),
            'provinsi' => strtoupper($this->provinsi),
            'kota' => strtoupper($this->kota),
            'updated_at' => now(),
        ]);

        $currentKodeRegistrasi = DataRegistrasi::where('id_calon_siswa', $this->id_calon_siswa)->first()->nomor_peserta;
        $nomor_peserta = $this->id_jalur == 1 ? 'R' : 'A';
        $newKodeRegistrasi = $nomor_peserta . substr($currentKodeRegistrasi, 1);

        DataRegistrasi::where('id_calon_siswa', $this->id_calon_siswa)->update([
            'id_jalur' => $this->id_jalur,
            'nomor_peserta' => $newKodeRegistrasi,
        ]);

        $user = User::find($this->siswa->id_user);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);

        session()->flash('message', 'Data berhasil diperbarui.');
    }

    protected function formatJadwalTes($idJadwalTes)
    {
        $jadwalTes = JadwalTes::find($idJadwalTes);
        if ($jadwalTes) {
            $formattedDate = Carbon::parse($jadwalTes->tanggal)->format('d-m-Y');
            return "{$formattedDate} {$jadwalTes->jam_mulai} - {$jadwalTes->jam_selesai} WIB / Ruang {$jadwalTes->ruang}";
        }
        return '';
    }


    // public function cetakKartuPeserta()
    // {
    //     $berkases = $this->siswa->user->berkas;
    //     foreach ($berkases as $berkas) {
    //         if ($berkas->persyaratan->nama_persyaratan == 'Pas Foto') {
    //             $encodedPath = base64_encode($berkas->file_name);
    //             $this->urlPasFoto = $berkas->file_name;
    //         }
    //     }

    //     $siswa = $this->siswa;
    //     $id_registrasi = $siswa->dataRegistrasi->id_registrasi;
    //     $jadwalWawancara = DataTes::where('id_registrasi', $id_registrasi)->get();

    //     foreach ($jadwalWawancara as $jadwal) {
    //         if (strpos($jadwal->jadwalTes->jenisTes->nama, 'BQ') !== false) {
    //             $jadwalBqWawancara = $jadwal->id_jadwal_tes;
    //         } else {
    //             $jadwalJapresWawancara = $jadwal->id_jadwal_tes;
    //         }
    //     }

    //     $jadwalBq = $this->formatJadwalTes($jadwalBqWawancara);
    //     $jadwalJapres = $this->formatJadwalTes($jadwalJapresWawancara);

    //     $pdf = Pdf::loadView('mail.kartu-peserta', [
    //         'pas_foto' => $this->urlPasFoto ? Storage::path($this->urlPasFoto) : null,
    //         'siswa' => $this->siswa,
    //         'jadwal_bq_wawancara' => $jadwalBq,
    //         'jadwal_japres_tes_akademik' => $jadwalJapres,
    //     ]);

    //     return response()->streamDownload(
    //         fn() => print($pdf->output()),
    //         'kartu-peserta-' . $siswa->nama_lengkap . '.pdf'
    //     );
    // }

    public function previewKartuPeserta()
    {
        $berkases = $this->siswa->user->berkas;
        foreach ($berkases as $berkas) {
            if ($berkas->persyaratan->nama_persyaratan == 'Pas Foto') {
                $this->urlPasFoto = $berkas->file_name;
            }
        }

        $siswa = $this->siswa;
        $id_registrasi = $siswa->dataRegistrasi->id_registrasi;
        $jadwalWawancara = DataTes::where('id_registrasi', $id_registrasi)->get();

        foreach ($jadwalWawancara as $jadwal) {
            if (strpos($jadwal->jadwalTes->jenisTes->nama, 'BQ') !== false) {
                $jadwalBqWawancara = $jadwal->id_jadwal_tes;
            } else {
                $jadwalJapresWawancara = $jadwal->id_jadwal_tes;
            }
        }

        $jadwalBq = $this->formatJadwalTes($jadwalBqWawancara);
        $jadwalJapres = $this->formatJadwalTes($jadwalJapresWawancara);

        $pdf = Pdf::loadView('mail.kartu-peserta', [
            'pas_foto' => $this->urlPasFoto ? Storage::path($this->urlPasFoto) : null,
            'siswa' => $this->siswa,
            'jadwal_bq_wawancara' => $jadwalBq,
            'jadwal_japres_tes_akademik' => $jadwalJapres,
        ]);

        $filePath = 'temp/kartu-peserta-' . $siswa->id_calon_siswa . '-' . uniqid() . '.pdf';
        Storage::disk('local')->put($filePath, $pdf->output());

        $this->previewUrlKartuPeserta = Storage::disk('local')->temporaryUrl($filePath, now()->addMinutes(5));

        return redirect($this->previewUrlKartuPeserta);
    }

    public function closeModalKartuPeserta()
    {
        $this->showModalKartuPeserta = false;
    }

    public function previewSuratKeterangan()
    {
        $siswa = $this->siswa;
        $status = $siswa->dataRegistrasi->status;
        $pdf = Pdf::loadView('mail.surat-keterangan', [
            'siswa' => $this->siswa,
            'status' => $status,
        ]);

        $filePath = 'temp/surat-keterangan-' . $siswa->id_calon_siswa . '-' . uniqid() . '.pdf';
        Storage::disk('local')->put($filePath, $pdf->output());

        $this->previewUrlSuratKeterangan = Storage::disk('local')->temporaryUrl($filePath, now()->addMinutes(5));

        return redirect($this->previewUrlSuratKeterangan);
    }

    public function closeModalSuratKeterangan()
    {
        $this->showModalSuratKeterangan = false;
    }


    // public function cetakSuratKeterangan()
    // {
    //     $siswa = $this->siswa;
    //     $status = $siswa->dataRegistrasi->status;
    //     $pdf = Pdf::loadView('mail.surat-keterangan', [
    //         'siswa' => $this->siswa,
    //         'status' => $status,
    //     ]);

    //     // return response()->streamDownload(
    //     //     fn() => print($pdf->output()),
    //     //     'surat-keterangan-' . $siswa->nama_lengkap . '.pdf'
    //     // );
    // }

    public function render()
    {
        return view('livewire.operator.tab-detail-siswa');
    }
}
