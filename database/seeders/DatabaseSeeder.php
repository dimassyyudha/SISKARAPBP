<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AccountSeeder::class);
        $this->call(FakultasSeeder::class);
        $this->call(ProgramStudiSeeder::class);
        $this->call(TahunAjaranSeeder::class);
        $this->call(RuangSeeder::class);
        $this->call(DosenSeeder::class);
        $this->call(MahasiswaSeeder::class);
        $this->call(MatakuliahSeeder::class);
        $this->call(PengampuSeeder::class);
        $this->call(JadwalSeeder::class);
        $this->call(IrsSeeder::class);
        $this->call(RiwayatStatusSeeder::class);

    }
}
