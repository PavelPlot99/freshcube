<?php

namespace App\Http\Controllers;

use App\Actions\LeadAction;
use App\Http\Requests\Lead\LinkContactRequest;
use App\Http\Resources\Lead\IndexLeadResource;
use App\Models\Lead;
use App\Services\AmoCrmService\AmoCrmService;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::query()->with('contacts')->orderByDesc('created_at')->get();

        return IndexLeadResource::collection($leads);
    }

    public function show(Lead $lead)
    {
        return IndexLeadResource::make($lead);
    }

    public function addContact(LinkContactRequest $request, Lead $lead, LeadAction $action)
    {
        $action->addContact($request->validated(), $lead);
    }
}