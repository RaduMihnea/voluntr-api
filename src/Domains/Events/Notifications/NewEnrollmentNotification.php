<?php

namespace Domain\Events\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewEnrollmentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly string $eventName,
        private readonly string $eventSlug,
    ) {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('mails.new_enrollment.subject'))
            ->view('mails.organization.newEnrollment', [
                'eventName' => $this->eventName,
                'eventLink' => config('app.client_app_url').'/organization/events/'.$this->eventSlug.'/edit',
            ]);
    }
}
