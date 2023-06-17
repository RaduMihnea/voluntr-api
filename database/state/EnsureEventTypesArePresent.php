<?php

namespace Database\State;

use Domain\Events\Models\EventType;
use Illuminate\Support\Facades\DB;

class EnsureEventTypesArePresent
{
    public function __invoke(): void
    {
        if ($this->present()) {
            return;
        }

        $eventTypesJson = file_get_contents(database_path('state/data/event_types.json'));
        $eventTypes = json_decode($eventTypesJson, true);

        DB::table('event_types')->insert($eventTypes);
    }

    public function present(): bool
    {
        return EventType::count() > 0;
    }
}
