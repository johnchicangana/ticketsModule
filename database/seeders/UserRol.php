<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRol extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_rols')->insert([
            [
                'user_id' => 1,
                'rol_id' => 4,
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'rol_id' => 2,
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'user_id' => 3,
                'rol_id' => 3,
                'created_at' => now(), 'updated_at' => now()
            ],
        ]);
    }
}
