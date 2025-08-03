<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Ahmed Benali',
                'role' => 'Étudiant en Terminale',
                'message' => 'Elmoumen Academy a transformé mon approche de l\'apprentissage. Les professeurs sont excellents et le contenu est très bien structuré.',
                'is_active' => true,
            ],
            [
                'name' => 'Fatima Zahra',
                'role' => 'Étudiante en Collège',
                'message' => 'Grâce à Elmoumen Academy, j\'ai pu améliorer mes résultats scolaires de manière significative. Je recommande vivement !',
                'is_active' => true,
            ],
            [
                'name' => 'Mohammed Alami',
                'role' => 'Étudiant en Primaire',
                'message' => 'Les cours sont très bien organisés et les professeurs sont toujours disponibles pour répondre à nos questions.',
                'is_active' => true,
            ],
            [
                'name' => 'Sara Bennani',
                'role' => 'Candidat Concours',
                'message' => 'Excellente plateforme pour préparer les concours. Le contenu est riche et les exercices sont très pertinents.',
                'is_active' => true,
            ],
            [
                'name' => 'Nadia Tazi',
                'role' => 'Parent d\'Élève',
                'message' => 'Ma fille a fait d\'énormes progrès depuis qu\'elle suit les cours d\'Elmoumen Academy. Je suis très satisfaite.',
                'is_active' => true,
            ],
            [
                'name' => 'Youssef Idrissi',
                'role' => 'Étudiant en Lycée',
                'message' => 'Interface intuitive et contenu de qualité. Elmoumen Academy est vraiment une référence en matière d\'éducation en ligne.',
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
