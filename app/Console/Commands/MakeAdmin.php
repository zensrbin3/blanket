<?php

namespace App\Console\Commands;

use App\Models\User;
use Couchbase\QueryException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blanket:create-admin {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kreiranje Admina';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $user = User::create([
                'name' => $this->argument('name'),
                'email' => $this->argument('email'),
                'password' => Hash::make($this->argument('password')),
            ]);

            $this->info("Admin {$this->argument('name')} uspešno kreiran.");
        } catch (QueryException $e) {
            if (strpos($e->getMessage(), 'email') !== false) {
                $this->error("Nemoguće je kreirati admina. Email već postoji.");

            } else {
                $this->error("Nemoguće je kreirati admina. Greška: " . $e->getMessage());
            }
        } catch (\Exception $e) {
            // Obrađivanje ostalih grešaka
            $this->error("Došlo je do greške: " . $e->getMessage());
        }
    }
}
