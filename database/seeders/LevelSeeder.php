<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level::insert([
            ['name' => 'Primaire'],
            ['name' => 'Collège'],
            ['name' => 'Lycée'], 
            ['name' => 'Concours'],
        ]);
    }
}
