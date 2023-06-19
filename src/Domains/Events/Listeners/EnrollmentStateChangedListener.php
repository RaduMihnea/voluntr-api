<?php

namespace Domain\Events\Listeners;

use Domain\Events\Enums\EnrollmentStateEnum;
use Spatie\ModelStates\Events\StateChanged;

class EnrollmentStateChangedListener
{
    public function handle(StateChanged $event)
    {
        if ($event->finalState == EnrollmentStateEnum::APPROVED) {
            $event->model->volunteer->registerBadgeProgress('enrollment-approved');

            foreach ($event->model->event->eventTypes as $eventType) {
                $event->model->volunteer->registerBadgeProgress("enrollment-$eventType->translation_slug");
            }
        }
    }
}
