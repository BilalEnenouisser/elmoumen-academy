<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Year;

class CheckLyceeYears extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:lycee-years';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check years for Lycée level';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $years = Year::with('level')->get();
        
        $this->info('All years:');
        foreach ($years as $year) {
            $this->line("{$year->name} - {$year->level->name}");
        }
        
        $this->info('');
        $this->info('Years for Lycée:');
        foreach ($years as $year) {
            if (stripos($year->level->name, 'lycée') !== false || stripos($year->level->name, 'lycee') !== false) {
                $this->line("{$year->name} - {$year->level->name}");
            }
        }
    }
}
