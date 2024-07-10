<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExportDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:export';

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
        $host = config('database.connections.mysql.host');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $database = config('database.connections.mysql.database');

        // Output file path
        $outputFile = storage_path('app/database/database_dump_'.date("Y-m-d").'.sql');

        // Build the mysqldump command
        $command = "mysqldump --host={$host} --user={$username} --password={$password} {$database} > {$outputFile}";

        // Execute the command
        exec($command, $output, $returnValue);

        // Check the command execution result
        if ($returnValue !== 0) {
            return response()->download($outputFile)->deleteFileAfterSend(true);

        } else {
            $this->info("Database exported successfully to {$outputFile}");
        }
    }
}
