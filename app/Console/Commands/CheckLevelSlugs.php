<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Level;

class CheckLevelSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:level-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check level names and their slugs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $levels = Level::all();
        
        $this->info('Levels and their slugs:');
        foreach ($levels as $level) {
            $this->line("{$level->name} - {$level->slug}");
        }
        
        $this->info('');
        $this->info('Expected URLs:');
        foreach ($levels as $level) {
            $this->line("http://127.0.0.1:8000/courses/{$level->slug}");
        }
    }
}
