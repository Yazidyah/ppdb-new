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
            $this->userSync($pg, $pgbackup);
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
        $this->info("User data synced successfully.");
    }
}
