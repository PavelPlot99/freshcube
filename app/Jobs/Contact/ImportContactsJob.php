<?php

namespace App\Jobs\Contact;

use App\Models\Contact;
use App\Services\AmoCrmService\AmoCrmService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportContactsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $service;
    public $page = 1;
    public $limit = 50;
    public function __construct($page = 1, $limit = 50)
    {
        $this->page = $page;
        $this->limit = $limit;
        $this->service = app(AmoCrmService::class);
    }

    public function handle()
    {
        $data = $this->service->contact()->list($this->limit, $this->page);
        $contacts = collect(data_get($data, '_embedded.contacts'));

        $contacts->each(function ($contact) {
            $external_id = data_get($contact, 'id');
            $contactModel = Contact::query()->firstWhere('external_id', $external_id);
            if($contactModel){
                if($contactModel->updated_at->timestamp === data_get($contact, 'updated_at')){
                    return;
                }
            }
            if(data_get($contact, 'is_deleted')){
                if($contactModel) {
                    $contactModel->delete();
                }else {
                    return;
                }
            }

            $item = [
                'name' => data_get($contact, 'name'),
                'external_id' => data_get($contact, 'id'),
                'first_name' => data_get($contact, 'first_name'),
                'last_name' => data_get($contact, 'last_name'),
                'created_at' => data_get($contact, 'created'),
                'updated_at' => data_get($contact, 'updated'),
            ];

            ImportContactJob::dispatch($item);
        });

        if($this->limit === $contacts->count()) {
            self::dispatch($this->page + 1, $this->limit);
        }
    }
}
