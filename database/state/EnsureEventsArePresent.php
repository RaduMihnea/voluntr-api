<?php

namespace Database\State;

use Domain\Events\Models\Event;
use Illuminate\Support\Facades\DB;

class EnsureEventsArePresent
{
    public function __invoke(): void
    {
        if ($this->present()) {
            return;
        }

        $eventJson = file_get_contents(database_path('state/data/event.json'));
        $events = json_decode($eventJson, true);

        DB::table('events')->insert($events);
    }

    public function present(): bool
    {
        return Event::count() > 0;
    }
}
