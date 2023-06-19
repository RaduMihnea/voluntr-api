<?php

namespace Database\State;

use Domain\Volunteer\Models\Volunteer;

class EnsureVolunteersArePresent
{
    public function __invoke(): void
    {
        if ($this->present()) {
            return;
        }

        $volunteersJson = file_get_contents(database_path('state/data/volunteers.json'));
        $volunteers = json_decode($volunteersJson, true);

        foreach ($volunteers as $volunteer) {
            Volunteer::create([
                ...$volunteer,
            ]);
        }
    }

    public function present(): bool
    {
        return Volunteer::count() > 0;
    }
}
