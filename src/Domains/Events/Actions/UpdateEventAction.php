<?php

namespace Domain\Events\Actions;

use Domain\Events\DTOs\EventCreateData;
use Domain\Events\Models\Event;

class UpdateEventAction
{
    public function __invoke(Event $event, EventCreateData $data, array $typeIds): Event
    {
        $event->update($data->toArray());

        $event->eventTypes()->sync($typeIds);

        return $event->fresh();
    }
}
