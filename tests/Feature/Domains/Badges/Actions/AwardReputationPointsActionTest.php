<?php

use Domain\Badges\Actions\AwardReputationPointsAction;
use Domain\Badges\Models\Badge;
use Domain\Badges\Models\BadgeProgress;

it('awards points for each completed badge', function () {
    $badgeProgress = BadgeProgress::factory()->create([
        'progress' => 10,
    ]);

    Badge::factory()->count(2)->create([
        'badge_progress_slug' => $badgeProgress->slug,
        'required_completion_amount' => 10,
        'awarded_points' => 5,
    ]);

    app(AwardReputationPointsAction::class)($badgeProgress);

    $this->assertEquals(10, $badgeProgress->volunteer->reputation_points);
});
