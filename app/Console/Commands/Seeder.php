<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Seeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'populate the database with examples';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dockerCommand = 'docker exec -it laravel php artisan db:seed --class=MateriasTableSeeder --force';
        $this->info('Running seeder...');
        exec($dockerCommand, $output);
        $this->info(implode("\n", $output));
    }
}
