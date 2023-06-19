<?php

namespace Domain\Badges\Actions;

use Domain\Badges\Models\BadgeProgress;

class AwardReputationPointsAction
{
    public function __invoke(BadgeProgress $badgeProgress): void
    {
        foreach ($badgeProgress->badges() as $badge) {
            if ($badgeProgress->progress === $badge->required_completion_amount) {
                $badgeProgress->volunteer->increment('reputation_points', $badge->awarded_points);
            }
        }
    }
}
