<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use App\Http\Requests\Events\IndexEventRequest;
use App\Http\Requests\Events\StoreEventRequest;
use Domain\Events\Actions\CreateEventAction;
use Domain\Events\DTOs\EventCreateData;
use Domain\Events\DTOs\EventData;
use Domain\Events\Queries\IndexEventQuery;
use Spatie\LaravelData\PaginatedDataCollection;

class EventController extends Controller
{
    public function index(IndexEventRequest $request): PaginatedDataCollection
    {
        $query = new IndexEventQuery($request);

        return EventData::collection($query->paginate());
    }

    public function store(StoreEventRequest $request, CreateEventAction $createEventAction): EventData
    {
        $event = $createEventAction(
            data: EventCreateData::from($request->validated()),
            typeIds: $request->get('type_ids')
        );

        return EventData::from($event);
    }
}
