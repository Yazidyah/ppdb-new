<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDOException;

class SyncDbBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-db-backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ini buat sync database backup';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $pg = DB::connection('pgsql');
            $this->info("Connected to main database");

            $pgbackup = DB::connection('backup');
            $this->info("Connected to backup database");

            // table user
            // $this->userSync($pg, $pgbackup);

            // table calon_siswa
            $this->calonSiswaSync($pg, $pgbackup);
        } catch (PDOException $e) {
            $this->error("Database error: " . $e->getMessage());
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
        }

        return 0;
    }

    public function userSync($pg, $pgbackup)
    {
        $user = User::all();

        foreach ($user as $u) {
            Log::channel('scheduler')->info("Syncing user: " . $u->name);

            $user_id = $u->id;

            $exists = $pgbackup->table('users')->where('id', $user_id)->exists();
            if (!$exists) {
                $pgbackup->table('users')->insert([
                    'id' => $u->id,
                    'name' => $u->name,
                    'email' => $u->email,
                    'password' => $u->password,
                    'remember_token' => $u->remember_token,
                    'created_at' => $u->created_at,
                    'updated_at' => $u->updated_at,
                ]);
                Log::channel('scheduler')->info("User " . $u->name . " synced successfully.");
            } else {
                Log::channel('scheduler')->info("User " . $u->name . " already exists in backup database.");
                $pgbackup->table('users')->where('id', $user_id)->update([
                    'name' => $u->name,
                    'email' => $u->email,
                    'password' => $u->password,
                    'remember_token' => $u->remember_token,
                    'created_at' => $u->created_at,
                    'updated_at' => $u->updated_at,
                ]);
                Log::channel('scheduler')->info("User " . $u->name . " updated successfully.");
            }
        }
        Log::channel('scheduler')->info("User data synced successfully.");
    }

    public function calonSiswaSync($pg, $pgbackup)
    {
        // dd('calon siswa sync');
        $calonSiswa = DB::table('calon_siswa')->whereNull('deleted_at')->get();

        foreach ($calonSiswa as $cs) {
            Log::channel('scheduler')->info("Syncing calon siswa: " . $cs->nama_lengkap);

            $calon_siswa_id = $cs->id_calon_siswa;

            $exists = $pgbackup->table('calon_siswa')->where('id_calon_siswa', $calon_siswa_id)->exists();
            if (!$exists) {
                $pgbackup->table('calon_siswa')->insert([
                    'id_calon_siswa' => $cs->id_calon_siswa,
                    'id_user' => $cs->id_user,
                    'nama_lengkap' => $cs->nama_lengkap,
                    'NIK' => $cs->NIK,
                    'NISN' => $cs->NISN,
                    'no_telp' => $cs->no_telp,
                    'jenis_kelamin' => $cs->jenis_kelamin,
                    'tempat_lahir' => $cs->tempat_lahir,
                    'tanggal_lahir' => $cs->tanggal_lahir,
                    'NPSN' => $cs->NPSN,
                    'sekolah_asal' => $cs->sekolah_asal,
                    'status_sekolah' => $cs->status_sekolah,
                    'predikat_akreditasi_sekolah' => $cs->predikat_akreditasi_sekolah,
                    'nilai_akreditasi_sekolah' => $cs->nilai_akreditasi_sekolah,
                    'alamat_domisili' => $cs->alamat_domisili,
                    'alamat_kk' => $cs->alamat_kk,
                    'provinsi' => $cs->provinsi,
                    'kota' => $cs->kota,
                    'created_at' => $cs->created_at,
                    'updated_at' => $cs->updated_at,
                    'deleted_at' => $cs->deleted_at,
                ]);
                Log::channel('scheduler')->info("Calon siswa " . $cs->nama_lengkap . " synced successfully.");
            } else {
                Log::channel('scheduler')->info("Calon siswa " . $cs->nama_lengkap . " already exists in backup database.");
                $pgbackup->table('calon_siswa')->where('id_calon_siswa', $calon_siswa_id)->update([
                    'nama_lengkap' => $cs->nama_lengkap,
                    'NIK' => $cs->NIK,
                    'NISN' => $cs->NISN,
                    'no_telp' => $cs->no_telp,
                    'jenis_kelamin' => $cs->jenis_kelamin,
                    'tempat_lahir' => $cs->tempat_lahir,
                    'tanggal_lahir' => $cs->tanggal_lahir,
                    'NPSN' => $cs->NPSN,
                    'sekolah_asal' => $cs->sekolah_asal,
                    'status_sekolah' => $cs->status_sekolah,
                    'predikat_akreditasi_sekolah' => $cs->predikat_akreditasi_sekolah,
                    'nilai_akreditasi_sekolah' => $cs->nilai_akreditasi_sekolah,
                    'alamat_domisili' => $cs->alamat_domisili,
                    'alamat_kk' => $cs->alamat_kk,
                    'provinsi' => $cs->provinsi,
                    'kota' => $cs->kota,
                    'created_at' => $cs->created_at,
                    'updated_at' => $cs->updated_at,
                    'deleted_at' => $cs->deleted_at,
                ]);
                Log::channel('scheduler')->info("Calon siswa " . $cs->nama_lengkap . " updated successfully.");
            }
        }
        Log::channel('scheduler')->info("Calon siswa data synced successfully.");
    }

    // public function dataRegistrasiSync($pg, $pgbackup)
    // {
    //     $dataRegistrasi = DB::table('data_registrasi')->get();

    //     foreach ($dataRegistrasi as $dr) {
    //         Log::channel('scheduler')->info("Syncing data registrasi: " . $dr->name);

    //         $data_registrasi_id = $dr->id;

    //         $exists = $pgbackup->table('data_registrasi')->where('id', $data_registrasi_id)->exists();
    //         if (!$exists) {
    //             $pgbackup->table('data_registrasi')->insert([
    //                 'id_registrasi' => $dr->id_registrasi,
    //                 'id_calon_siswa' => $dr->id_calon_siswa,
    //                 'id_jalur' => $dr->id_jalur,
    //                 'created_at' => $dr->created_at,
    //                 'updated_at' => $dr->updated_at,
    //             ]);
    //             Log::channel('scheduler')->info("Data registrasi " . $dr->name . " synced successfully.");
    //         } else {
    //             Log::channel('scheduler')->info("Data registrasi " . $dr->name . " already exists in backup database.");
    //             $pgbackup->table('data_registrasi')->where('id', $data_registrasi_id)->update([
    //                 'status' => $dr->status,
    //                 'created_at' => $dr->created_at,
    //                 'updated_at' => $dr->updated_at,
    //             ]);
    //             Log::channel('scheduler')->info("Data registrasi " . $dr->name . " updated successfully.");
    //         }
    //     }
    //     Log::channel('scheduler')->info("Data registrasi data synced successfully.");
    // }
}
