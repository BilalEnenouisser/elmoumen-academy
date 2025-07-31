<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\BookCategory;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = BookCategory::all();

        $books = [
            [
                'name' => 'Mathématiques Avancées - Niveau Lycée',
                'description' => 'Un livre complet couvrant tous les concepts de mathématiques pour le niveau lycée, incluant l\'algèbre, la géométrie, et le calcul.',
                'price' => 150.00,
                'reduced_price' => 120.00,
                'category_id' => $categories->where('name', 'Mathématiques')->first()->id,
                'is_active' => true
            ],
            [
                'name' => 'Physique Quantique - Concepts Fondamentaux',
                'description' => 'Introduction aux concepts de la physique quantique avec des explications claires et des exercices pratiques.',
                'price' => 180.00,
                'reduced_price' => 144.00,
                'category_id' => $categories->where('name', 'Physique')->first()->id,
                'is_active' => true
            ],
            [
                'name' => 'Chimie Organique - Méthodes et Applications',
                'description' => 'Guide complet de la chimie organique avec des exemples concrets et des applications pratiques.',
                'price' => 160.00,
                'reduced_price' => null,
                'category_id' => $categories->where('name', 'Chimie')->first()->id,
                'is_active' => true
            ],
            [
                'name' => 'Biologie Cellulaire - Du Microscope à la Vie',
                'description' => 'Exploration fascinante de la biologie cellulaire avec des illustrations détaillées et des explications accessibles.',
                'price' => 140.00,
                'reduced_price' => 112.00,
                'category_id' => $categories->where('name', 'Biologie')->first()->id,
                'is_active' => true
            ],
            [
                'name' => 'Histoire du Maroc - De l\'Antiquité à nos Jours',
                'description' => 'Histoire complète du Maroc, de ses origines à l\'époque moderne, avec des cartes et des documents historiques.',
                'price' => 130.00,
                'reduced_price' => 104.00,
                'category_id' => $categories->where('name', 'Histoire')->first()->id,
                'is_active' => true
            ],
            [
                'name' => 'Grammaire Française - Règles et Exceptions',
                'description' => 'Guide complet de la grammaire française avec des exercices pratiques et des corrections détaillées.',
                'price' => 110.00,
                'reduced_price' => null,
                'category_id' => $categories->where('name', 'Français')->first()->id,
                'is_active' => true
            ],
            [
                'name' => 'English Grammar - From Basics to Advanced',
                'description' => 'Complete English grammar guide with exercises and practical examples for all levels.',
                'price' => 125.00,
                'reduced_price' => 100.00,
                'category_id' => $categories->where('name', 'Anglais')->first()->id,
                'is_active' => true
            ],
            [
                'name' => 'Philosophie Moderne - Penseurs et Concepts',
                'description' => 'Introduction à la philosophie moderne avec l\'étude des grands penseurs et leurs concepts fondamentaux.',
                'price' => 145.00,
                'reduced_price' => 116.00,
                'category_id' => $categories->where('name', 'Philosophie')->first()->id,
                'is_active' => true
            ],
            [
                'name' => 'Économie de Marché - Principes et Applications',
                'description' => 'Guide pratique de l\'économie de marché avec des exemples concrets et des études de cas.',
                'price' => 155.00,
                'reduced_price' => null,
                'category_id' => $categories->where('name', 'Économie')->first()->id,
                'is_active' => true
            ],
            [
                'name' => 'Programmation Python - De Débutant à Expert',
                'description' => 'Apprentissage complet de Python avec des projets pratiques et des exercices progressifs.',
                'price' => 170.00,
                'reduced_price' => 136.00,
                'category_id' => $categories->where('name', 'Informatique')->first()->id,
                'is_active' => true
            ]
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
} 