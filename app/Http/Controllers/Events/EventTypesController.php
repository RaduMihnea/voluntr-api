<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use Domain\Events\DTOs\EventTypeData;
use Domain\Events\Models\EventType;
use Spatie\LaravelData\DataCollection;

class EventTypesController extends Controller
{
    public function index(): DataCollection
    {
        return EventTypeData::collection(EventType::all());
    }
}
