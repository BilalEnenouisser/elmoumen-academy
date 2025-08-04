<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
                'name' => 'Dr. Ahmed Elmoumen',
                'email' => 'ahmed.elmoumen@elmoumen-academy.com',
                'password' => Hash::make('password123'),
                'role' => 'Fondateur & Directeur',
                'description' => 'Expert en pédagogie avec plus de 15 ans d\'expérience dans l\'éducation en ligne. Spécialiste en développement de programmes éducatifs innovants.',
                'is_active' => true,
                'show_in_about' => true,
                'display_order' => 1,
            ],
            [
                'name' => 'Prof. Fatima Zahra',
                'email' => 'fatima.zahra@elmoumen-academy.com',
                'password' => Hash::make('password123'),
                'role' => 'Responsable Pédagogique',
                'description' => 'Spécialiste en sciences de l\'éducation et en développement de programmes d\'études. Experte en méthodes d\'apprentissage modernes.',
                'is_active' => true,
                'show_in_about' => true,
                'display_order' => 2,
            ],
            [
                'name' => 'Ing. Youssef Benali',
                'email' => 'youssef.benali@elmoumen-academy.com',
                'password' => Hash::make('password123'),
                'role' => 'Responsable Technique',
                'description' => 'Expert en technologies éducatives et en développement de plateformes d\'apprentissage. Spécialiste en solutions numériques pour l\'éducation.',
                'is_active' => true,
                'show_in_about' => true,
                'display_order' => 3,
            ],
            [
                'name' => 'Prof. Sara Alami',
                'email' => 'sara.alami@elmoumen-academy.com',
                'password' => Hash::make('password123'),
                'role' => 'Experte en Langues',
                'description' => 'Spécialiste en langues étrangères et en méthodes d\'apprentissage innovantes. Experte en pédagogie linguistique.',
                'is_active' => true,
                'show_in_about' => true,
                'display_order' => 4,
            ],
            [
                'name' => 'Dr. Mohammed Tazi',
                'email' => 'mohammed.tazi@elmoumen-academy.com',
                'password' => Hash::make('password123'),
                'role' => 'Professeur de Mathématiques',
                'description' => 'Docteur en mathématiques avec une expertise en pédagogie. Spécialiste en résolution de problèmes et en logique mathématique.',
                'is_active' => true,
                'show_in_about' => false,
                'display_order' => 5,
            ],
            [
                'name' => 'Prof. Amina Bensouda',
                'email' => 'amina.bensouda@elmoumen-academy.com',
                'password' => Hash::make('password123'),
                'role' => 'Professeur de Physique',
                'description' => 'Experte en physique moderne et en sciences expérimentales. Spécialiste en méthodes d\'enseignement interactives.',
                'is_active' => true,
                'show_in_about' => false,
                'display_order' => 6,
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}
