<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EveryMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will clean the db table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        DB::table('department')->delete();
        echo "operation is done";
    }
}
