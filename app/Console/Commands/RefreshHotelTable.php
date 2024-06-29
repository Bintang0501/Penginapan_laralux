<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class RefreshHotelTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:refresh-hotel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop and re-run the migrations for the hotel table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Drop the hotel table if it exists
        if (Schema::hasTable('hotel')) {
            Schema::drop('hotel');
            $this->info('Dropped hotel table');
        }

        // Run the migration for hotel table
        Artisan::call('migrate', [
            '--path' => '/database/migrations/2024_06_27_235233_create_hotel_table.php' // Gantilah dengan nama file migrasi yang benar
        ]);

        $this->info('Re-migrated hotel table');

        return 0;
    }
}
