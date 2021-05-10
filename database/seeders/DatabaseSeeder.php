<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Species;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(['name' => 'John Doe', 'email' => 'john@example.com']);
        $aves = Species::factory(['name' => 'Aves'])->create();
        $bobinos = Species::factory(['name' => 'Bobinos'])->create();
        $cerdos = Species::factory(['name' => 'Cerdos'])->create();
        Product::factory(2)->create(['species_id' => $aves]);
        Product::factory(2)->create(['species_id' => $bobinos]);
        Product::factory(2)->create(['species_id' => $cerdos]);
    }
}
