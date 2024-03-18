<?php

namespace App\Console\Commands;

use App\Contract;
use App\Mail\ContractEmail;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Mail;

class ContractEnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contract:end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to user about the end of a contract';

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
     * @return mixed
     */
    public function handle()
    {
        $contracts = Contract::where('end_date', Carbon::parse(today())->addMonths(2)->toDateString())->get();

        foreach ($contracts as $contract) {
            Mail::to(Setting::first()->value('email'))->send(new ContractEmail($contract));
        }
        
        $this->info('Word of the Day sent to All Users');
    }
}
