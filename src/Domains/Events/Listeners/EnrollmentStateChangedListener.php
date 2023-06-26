<?php

namespace Domain\Events\Listeners;

use Domain\Events\Enums\EnrollmentStateEnum;
use Domain\Events\Notifications\EnrollmentStateChangedNotification;
use Spatie\ModelStates\Events\StateChanged;

class EnrollmentStateChangedListener
{
    public function handle(StateChanged $event)
    {
        $event->model->volunteer->notify((new EnrollmentStateChangedNotification(
            user: $event->model->volunteer->full_name,
            state: $event->finalState,
            event: $event->model->event->name,
        ))->locale($event->model->volunteer->city->country->iso_code));

        if ($event->finalState == EnrollmentStateEnum::APPROVED) {
            $event->model->volunteer->registerBadgeProgress('enrollment-approved');

            foreach ($event->model->event->eventTypes as $eventType) {
                $event->model->volunteer->registerBadgeProgress("enrollment-$eventType->translation_slug");
            }
        }
    }
}
