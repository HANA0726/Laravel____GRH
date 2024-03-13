<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Candidat;
class RefusNotification extends Notification
{
    use Queueable;
    private $candidat;
    /**
     * Create a new notification instance.
     */
    public function __construct( Candidat $candidat)
    {
        $this->candidat=$candidat;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Refus de candidature')
        ->greeting('Bonjour ' . $this->candidat->nom . ',')
        ->line('Nous avons examiné votre candidature pour le poste de ' . $this->candidat->poste . '.')
        ->line('Malheureusement, nous avons décidé de ne pas poursuivre votre candidature.')
        ->line('Nous vous remercions de votre intérêt pour notre entreprise et vous souhaitons bonne chance dans vos futures recherches.')
        ->line('Cordialement,')
        ->salutation('L\'équipe de recrutement Vala-Orange.');
    }

  
}
