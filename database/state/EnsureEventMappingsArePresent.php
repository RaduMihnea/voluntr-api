<?php

namespace Database\State;

use Illuminate\Support\Facades\DB;

class EnsureEventMappingsArePresent
{
    public function __invoke(): void
    {
        if ($this->present()) {
            return;
        }

        $eventMappingsJson = file_get_contents(database_path('state/data/event_event_types.json'));
        $eventMappings = json_decode($eventMappingsJson, true);

        DB::table('event_event_type')->insert($eventMappings);
    }

    public function present(): bool
    {
        return DB::table('event_event_type')->count() > 0;
    }
}
