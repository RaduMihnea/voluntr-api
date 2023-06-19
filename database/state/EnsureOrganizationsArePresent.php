<?php

namespace Database\State;

use Domain\Organization\Models\Organization;

class EnsureOrganizationsArePresent
{
    public function __invoke(): void
    {
        if ($this->present()) {
            return;
        }

        $organizationsJson = file_get_contents(database_path('state/data/organizations.json'));
        $organizations = json_decode($organizationsJson, true);

        foreach ($organizations as $organization) {
            Organization::create([
                ...$organization,
            ]);
        }
    }

    public function present(): bool
    {
        return Organization::count() > 0;
    }
}
