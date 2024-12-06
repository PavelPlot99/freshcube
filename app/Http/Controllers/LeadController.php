<?php

namespace App\Http\Controllers;

use App\Http\Resources\Lead\IndexLeadResource;
use App\Models\Lead;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::query()->with('contacts')->orderByDesc('created_at')->get();

        return IndexLeadResource::collection($leads);
    }

    public function addContact()
    {

    }
}