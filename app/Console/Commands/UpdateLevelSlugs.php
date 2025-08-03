<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Level;
use Illuminate\Support\Str;

class UpdateLevelSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'levels:update-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update existing levels with slugs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $levels = Level::all();
        
        $this->info('Updating level slugs...');
        
        foreach ($levels as $level) {
            $oldSlug = $level->slug;
            $level->slug = Str::slug($level->name);
            $level->save();
            
            $this->line("Updated {$level->name}: {$oldSlug} -> {$level->slug}");
        }
        
        $this->info('Level slugs updated successfully!');
    }
}
