<?php

namespace App\Jobs\Contact;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportContactJob implements ShouldQueue
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

        $contact = Contact::query()->firstWhere('external_id', $external_id);

        if(!$contact){
            $contact = Contact::query()->make($this->item);
        }else{
            $contact->update($this->item);
        }

        $contact->save();
    }
}
