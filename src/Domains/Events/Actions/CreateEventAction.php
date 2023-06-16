<?php

namespace Domain\Events\Actions;

use Domain\Events\DTOs\EventCreateData;
use Domain\Events\Models\Event;

class CreateEventAction
{
    public function __invoke(EventCreateData $data, array $typeIds): Event
    {
        $event = Event::create($data->toArray());

        $event->addMediaFromRequest('image')->toMediaCollection('cover');

        $event->eventTypes()->attach($typeIds);

        return $event;
    }
}
