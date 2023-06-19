<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use App\Http\Requests\Events\DeleteEventRequest;
use App\Http\Requests\Events\IndexEventRequest;
use App\Http\Requests\Events\StoreEventRequest;
use App\Http\Requests\Events\UpdateEventRequest;
use Domain\Events\Actions\CreateEventAction;
use Domain\Events\Actions\UpdateEventAction;
use Domain\Events\DTOs\EventCreateData;
use Domain\Events\DTOs\EventData;
use Domain\Events\Models\Event;
use Domain\Events\Queries\IndexEventQuery;
use Illuminate\Http\JsonResponse;
use Spatie\LaravelData\PaginatedDataCollection;

class EventController extends Controller
{
    public function index(IndexEventRequest $request): PaginatedDataCollection
    {
        $query = new IndexEventQuery($request);

        return EventData::collection($query->paginate($request->per_page));
    }

    public function store(StoreEventRequest $request, CreateEventAction $createEventAction): EventData
    {
        $event = $createEventAction(
            data: EventCreateData::from($request->validated()),
            typeIds: $request->get('type_ids')
        );

        return EventData::from($event);
    }

    public function update(Event $event, UpdateEventRequest $request, UpdateEventAction $updateEventAction): EventData
    {
        $event = $updateEventAction(
            event: $event,
            data: EventCreateData::from($request->validated()),
            typeIds: $request->get('type_ids')
        );

        if ($request->has('image')) {
            $event->addMediaFromRequest('image')->toMediaCollection('cover');
        }

        return EventData::from($event);
    }

    public function destroy(Event $event, DeleteEventRequest $request): JsonResponse
    {
        $event->delete();

        return $this->respondNoContent();
    }
}
