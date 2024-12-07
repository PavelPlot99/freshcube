<?php

namespace App\Http\Controllers;

use App\Http\Resources\Log\LogIndexResource;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function index()
    {
        $logs = Activity::query()->where('log_name', 'linked')->get();

        return LogIndexResource::collection($logs);
    }
}