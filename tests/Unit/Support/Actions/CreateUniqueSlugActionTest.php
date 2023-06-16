<?php

use Domain\Events\Models\Event;
use Support\Actions\CreateUniqueSlugAction;

it('creates a unique slug', function () {
    $event = Event::factory()->create([
        'name' => 'My Event',
        'slug' => 'my-event',
    ]);

    $slug = app(CreateUniqueSlugAction::class)(model: Event::class, title: 'My Event');

    expect($slug)->not->toBe($event->slug);
});

it('creates multiple unique slugs', function () {
    $event = Event::factory()->create([
        'name' => 'My Event',
        'slug' => 'my-event',
    ]);

    $slugA = app(CreateUniqueSlugAction::class)(model: Event::class, title: 'My Event');
    Event::factory()->create([
        'name' => 'My Event',
        'slug' => $slugA,
    ]);

    $slugB = app(CreateUniqueSlugAction::class)(model: Event::class, title: 'My Event');

    expect($slugA)->not->toBe($slugB);
});
