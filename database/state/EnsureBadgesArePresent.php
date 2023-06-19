<?php

namespace Database\State;

use Domain\Badges\Models\Badge;
use Illuminate\Support\Facades\DB;

class EnsureBadgesArePresent
{
    public function __invoke(): void
    {
        if ($this->present()) {
            return;
        }

        $badgesJson = file_get_contents(database_path('state/data/badges.json'));
        $badges = json_decode($badgesJson, true);

        DB::table('badges')->insert($badges);
    }

    public function present(): bool
    {
        return Badge::count() > 0;
    }
}
