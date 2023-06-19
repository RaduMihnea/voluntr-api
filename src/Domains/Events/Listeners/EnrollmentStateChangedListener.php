<?php

namespace Domain\Events\Listeners;

use Domain\Events\States\Approved;
use Spatie\ModelStates\Events\StateChanged;

class EnrollmentStateChangedListener
{
    public function handle(StateChanged $event)
    {
        if ($event->finalState == Approved::class) {
            $event->model->volunteer->registerBadgeProgress('enrollment');

            foreach ($event->model->event->eventTypes as $eventType) {
                $event->model->volunteer->registerBadgeProgress("enrollment-$eventType->translation_slug");
            }
        }
    }
}
