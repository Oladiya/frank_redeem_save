<?php

namespace Database\Seeders;

use App\Models\Service;
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

        User::factory()->create([
            'full_name' => 'Иванов Иван Иванович',
            'login' => 'adminka',
            'email' => 'test@example.com',
            'phone' => '+7(495)-123-45-67',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        Service::factory()->create(['name' => 'общий клининг',]);
        Service::factory()->create(['name' => 'генеральная уборка',]);
        Service::factory()->create(['name' => 'послестроительная уборка',]);
        Service::factory()->create(['name' => 'химчистка ковров и мебели',]);
    }
}
