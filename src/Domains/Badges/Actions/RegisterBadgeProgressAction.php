<?php

namespace Domain\Badges\Actions;

use Domain\Badges\Models\BadgeProgress;

class RegisterBadgeProgressAction
{
    public function __invoke(string $slug, int $volunteerId): BadgeProgress
    {
        $badgeProgress = BadgeProgress::where('slug', $slug)->where('volunteer_id', $volunteerId)->first();

        if ($badgeProgress) {
            $badgeProgress->increment('progress');

            return $badgeProgress->fresh();
        }

        $badgeProgress = BadgeProgress::create([
            'volunteer_id' => $volunteerId,
            'slug' => $slug,
            'progress' => 1,
        ]);

        app(AwardReputationPointsAction::class)($badgeProgress);

        return $badgeProgress;
    }
}
