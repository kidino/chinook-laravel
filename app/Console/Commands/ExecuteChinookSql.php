<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ExecuteChinookSql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chinook:execute-sql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute the chinook.sql file to populate the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filePath = base_path('database/sqldump/chinook.sql');

        if (!File::exists($filePath)) {
            $this->error("The file 'chinook.sql' does not exist in the 'database/sqldump' directory.");
            return Command::FAILURE;
        }

        try {
            $sql = File::get($filePath);
            DB::unprepared($sql);
            $this->info('The chinook.sql file has been successfully executed.');
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('An error occurred while executing the SQL file: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
