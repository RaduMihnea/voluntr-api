<?php

namespace Domain\Events\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EnrollmentStateChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly string $user,
        private readonly string $state,
        private readonly string $event,
    ) {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__("mails.enrollment_state_changed.$this->state.subject"))
            ->view('mails.volunteer.enrollmentStateChanged', [
                'user' => $this->user,
                'state' => $this->state,
                'event' => $this->event,
                'link' => $this->state === 'rejected' ?
                    config('app.client_app_url').'/volunteer/discover' : null,
            ]);
    }
}
