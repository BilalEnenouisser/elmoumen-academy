<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\Field;

class FixSubjectFieldsSeeder extends Seeder
{
    public function run(): void
    {
        $defaultField = Field::first();

        Subject::whereNull('field_id')->update([
            'field_id' => $defaultField->id ?? 1
        ]);
    }
}