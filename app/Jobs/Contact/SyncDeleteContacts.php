<?php

namespace App\Jobs\Contact;

use App\Models\Contact;
use App\Models\Lead;
use App\Services\AmoCrmService\AmoCrmService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncDeleteContacts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $service;
    public $page = 1;
    public $limit = 50;
    public function __construct($page = 1, $limit = 50)
    {
        $this->service = app(AmoCrmService::class);
    }

    public function handle()
    {
        $data = $this->service->contact()->list($this->limit, $this->page, ['with' => 'only_deleted']);
        $contacts = collect(data_get($data, '_embedded.contacts'));

        $contacts->each(function ($contact) {
            $external_id = data_get($contact, 'id');
            $contactModel = Contact::query()->firstWhere('external_id', $external_id);

            if($contactModel){
                $contactModel->delete();
            }
        });

        if($this->limit === $contacts->count()) {
            self::dispatch($this->page + 1, $this->limit);
        }

    }

}