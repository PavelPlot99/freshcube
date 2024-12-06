<?php

namespace App\Jobs\Lead;

use App\Models\Lead;
use App\Services\AmoCrmService\AmoCrmService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncDeletedLeads implements ShouldQueue
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
        $data = $this->service->lead()->list($this->limit, $this->page, ['with' => 'only_deleted']);
        $leads = collect(data_get($data, '_embedded.leads'));

        $leads->each(function ($lead) {
            $external_id = data_get($lead, 'id');
            $leadModel = Lead::query()->firstWhere('external_id', $external_id);

            if($leadModel){
                $leadModel->delete();
            }
        });

        if($this->limit === $leads->count()) {
            self::dispatch($this->page + 1, $this->limit);
        }

    }

}