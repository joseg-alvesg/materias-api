<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Migration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'migrate';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dockerCommand = 'docker exec -it laravel php artisan migrate --force';
        $this->info('Running migration...');
        exec($dockerCommand, $output);
        $this->info(implode("\n", $output));
    }
}
