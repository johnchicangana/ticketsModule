<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'permits' => json_encode(['create', 'read', 'update', 'delete']),
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Applicant',
                'permits' => json_encode(['create', 'read', 'update']),
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Support',
                'permits' => json_encode(['read', 'update']),
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Developer',
                'permits' => json_encode(['read', 'update']),
                'created_at' => now(), 'updated_at' => now()
            ],
        ]);
    }
}
