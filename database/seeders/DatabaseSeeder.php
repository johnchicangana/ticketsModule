<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create(
            [
                'name' => 'John',
                'last_name' => 'Chicangana',
                'email' => 'johnd.chicangana@gmail.com',
            ],
        );
        User::factory()->create(
            [
                'name' => 'Joe',
                'last_name' => 'Doe',
                'email' => 'test@test.com'
            ],
        );
        User::factory()->create(
            [
                'name' => 'Jane',
                'last_name' => 'Doe',
                'email' => 'test@testing.com'
            ],
        );
        $this->call([
            RolSeeder::class,
            UserRol::class,
        ]);
    }
}
