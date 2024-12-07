<?php

namespace App\Actions;

use App\Models\Lead;
use App\Services\AmoCrmService\AmoCrmService;

class LeadAction
{
    public function addContact($data, Lead $lead)
    {
        $service = app(AmoCrmService::class);
        $payload = [
                [
                    'first_name' => data_get($data, 'first_name'),
                    'last_name' => data_get($data, 'last_name'),
                    'custom_fields_values' =>
                        [
                            [
                                'field_code' => 'PHONE',
                                'values' => [
                                    ['value' => data_get($data, 'phone')]
                                ]
                            ],
                        ]

                ]
        ];

        $contact = $service->contact()->post($payload);

        $contact_id = data_get($contact, '_embedded.contacts.0.id');

        $service->note('contacts')->post([
            [
                "entity_id" => $contact_id,
                "note_type" => "common",
                "params" => [
                    'text' => data_get($data, 'description')
                ]
            ]

        ]);

        $service->link('contacts', $contact_id)->post([
            [
                'to_entity_id' => $lead->external_id,
                'to_entity_type' => 'leads'
            ]
        ]);

        activity()
            ->withProperties([
                'name' => "{$data['first_name']} {$data['last_name']}",
                'lead' => $lead->name,
            ])
            ->inLog('linked')
            ->log("Привязан контакт");
    }
}