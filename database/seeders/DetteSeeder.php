<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Client;
use App\Models\Dette;

class DetteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Client::all()->each(function ($client) {
            Dette::factory()
                ->count(3)
                ->create([
                    'client_id' => $client->id,
                ])
                ->each(function ($dette) {
                    $articles = Article::inRandomOrder()->take(rand(1, 5))->get();

                    foreach ($articles as $article) {
                        $dette->articles()->attach($article->id, [
                            'quantite' => rand(1, 10),
                        ]);
                    }
                });
        });
    }
}
