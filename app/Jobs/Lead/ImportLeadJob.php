<?php

namespace App\Jobs\Lead;

use App\Models\Contact;
use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportLeadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $item;
    public function __construct(array $item)
    {
        $this->item = $item;
    }

    public function handle()
    {
        $external_id = $this->item['external_id'];

        $lead = Lead::query()->firstWhere('external_id', $external_id);

        if(!$lead){
            $lead = Lead::query()->make($this->item);
        }else{
            $lead->update($this->item);
        }

        $lead->save();

        $contacts = Contact::query()->whereIn('external_id', $this->item['contacts'])->pluck('id');

        $lead->contacts()->sync($contacts);
    }

}