<?php

namespace App\Console\Commands;

use App\Mail\ExpiringContractsMail;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ExpiringContracts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $employees = Employee::all();
        // Mail::to("hr@email.com")->send(new ExpiringContractsMail(Employee::first()));

        foreach($employees as $emp){
            if ($emp->contract_expiry->before(now()->addMonths(1))) {
                #send emails to hr/ops
                Mail::to("hr@email.com")->send(new ExpiringContractsMail($emp));
            }
        };
        return 1;
    }
}
