<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Field;
use App\Models\Year;

class UpdateFieldsWithYearId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fields:update-year-id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update existing fields with year_id values';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tcYear = Year::where('name', 'TC')->first();
        $bac1Year = Year::where('name', '1Bac')->first();
        $bac2Year = Year::where('name', '2Bac')->first();

        if (!$tcYear || !$bac1Year || !$bac2Year) {
            $this->error('Required years not found!');
            return;
        }

        // Get all fields that don't have year_id
        $fields = Field::whereNull('year_id')->get();
        
        $this->info("Found {$fields->count()} fields without year_id");
        
        foreach ($fields as $index => $field) {
            // Distribute fields across the three years
            if ($index % 3 == 0) {
                $field->update(['year_id' => $tcYear->id]);
                $this->line("Updated {$field->name} with TC year");
            } elseif ($index % 3 == 1) {
                $field->update(['year_id' => $bac1Year->id]);
                $this->line("Updated {$field->name} with 1Bac year");
            } else {
                $field->update(['year_id' => $bac2Year->id]);
                $this->line("Updated {$field->name} with 2Bac year");
            }
        }

        $this->info('Fields updated successfully!');
    }
}
