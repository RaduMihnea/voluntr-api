<?php

use Domain\Badges\Actions\RegisterBadgeProgressAction;
use Domain\Badges\Models\BadgeProgress;
use Domain\Volunteer\Models\Volunteer;

it('can create new badge progress if it doesnt exist', function () {
   $volunteer = Volunteer::factory()->create();

   app(RegisterBadgeProgressAction::class)('badge-slug', $volunteer->id);

    $this->assertDatabaseHas('badge_progress', [
        'volunteer_id' => $volunteer->id,
        'slug' => 'badge-slug',
        'progress' => 1,
    ]);
});

it('update badge progess if it exists', function () {
    $volunteer = Volunteer::factory()->create();
    $badgeProgress = BadgeProgress::factory()->create([
        'volunteer_id' => $volunteer->id,
        'slug' => 'badge-slug',
        'progress' => 1,
    ]);

    app(RegisterBadgeProgressAction::class)('badge-slug', $volunteer->id);

    expect($badgeProgress->fresh()->progress)->toBe(2);
});
