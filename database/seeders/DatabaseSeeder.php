<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::updateOrCreate(['libelle' => 'admin'], ['libelle' => 'admin']);
        Role::updateOrCreate(['libelle' => 'boutiquier'], ['libelle' => 'boutiquier']);
        Role::updateOrCreate(['libelle' => 'client'], ['libelle' => 'client']);

        $this->call([
            ClientSeeder::class,
            UserSeeder::class,
            ClientUserSeeder::class,
            ArticleSeeder::class,
            DetteSeeder::class,
        ]);
    }
}
