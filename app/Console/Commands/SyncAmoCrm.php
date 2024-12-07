<?php

namespace App\Console\Commands;

use App\Jobs\Contact\ImportContactsJob;
use App\Jobs\Contact\SyncDeleteContacts;
use App\Jobs\Lead\ImportLeadsJob;
use App\Jobs\Lead\SyncDeletedLeads;
use App\Services\AmoCrmService\AmoCrmService;
use Illuminate\Console\Command;

class SyncAmoCrm extends Command
{

    protected $signature = 'sync:amocrm';


    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        ImportContactsJob::dispatch();
        ImportLeadsJob::dispatch();
        SyncDeleteContacts::dispatch();
        SyncDeletedLeads::dispatch();
    }
}
