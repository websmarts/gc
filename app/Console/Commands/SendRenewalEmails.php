<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendRenewalEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'renewals:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scans membership models ans sends renewal messages where due ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Display this on the screen');
        return 0;
    }
}
