<?php

namespace App\Console\Commands;

use App\Jobs\Contact\ImportContactsJob;
use App\Jobs\Lead\ImportLeadsJob;
use App\Services\AmoCrmService\AmoCrmService;
use Illuminate\Console\Command;

class Test extends Command
{

    protected $signature = 'app:test';


    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
//        ImportContactsJob::dispatch();
        ImportLeadsJob::dispatch();
    }
}
