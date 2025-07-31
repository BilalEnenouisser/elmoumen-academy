<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BookCategory;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Mathématiques',
                'description' => 'Livres de mathématiques pour tous les niveaux'
            ],
            [
                'name' => 'Physique',
                'description' => 'Livres de physique et sciences'
            ],
            [
                'name' => 'Chimie',
                'description' => 'Livres de chimie et laboratoire'
            ],
            [
                'name' => 'Biologie',
                'description' => 'Livres de biologie et sciences naturelles'
            ],
            [
                'name' => 'Histoire',
                'description' => 'Livres d\'histoire et géographie'
            ],
            [
                'name' => 'Français',
                'description' => 'Livres de français et littérature'
            ],
            [
                'name' => 'Anglais',
                'description' => 'Livres d\'anglais et langues'
            ],
            [
                'name' => 'Philosophie',
                'description' => 'Livres de philosophie et pensée'
            ],
            [
                'name' => 'Économie',
                'description' => 'Livres d\'économie et gestion'
            ],
            [
                'name' => 'Informatique',
                'description' => 'Livres d\'informatique et programmation'
            ]
        ];

        foreach ($categories as $category) {
            BookCategory::create($category);
        }
    }
} 