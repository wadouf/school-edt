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
        // Ordre important : d'abord les rôles, puis les données scolaires, puis les utilisateurs
        $this->call([
            RolePermissionSeeder::class,
            SchoolDataSeeder::class,
            UserSeeder::class,
        ]);
    }
}
