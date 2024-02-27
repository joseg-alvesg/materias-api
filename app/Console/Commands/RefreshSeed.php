<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RefreshSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh-seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dockerCommand = 'docker exec -it laravel php artisan migrate:refresh --force ; docker exec -it laravel php artisan db:seed --class=MateriasTableSeeder --force';
        $this->info('Running migration and seeder...');
        exec($dockerCommand, $output);
    }
}
