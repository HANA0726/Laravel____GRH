<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Candidat;
class CandidatureNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(Candidat $candidat)
    {
        $this->$candidat=$candidat;
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
        ->subject('Confirmation de candidature')
        ->greeting('Bonjour '.$notifiable->prenom.',')
        ->line('Nous avons bien reçu votre candidature pour le poste de '.$notifiable->poste.'.')
        ->line('Nous vous confirmons que votre candidature a bien été prise en compte.')
        ->line('Nous vous remercions pour l\'intérêt que vous portez à notre entreprise.')
        ->line('Si votre profil correspond à nos attentes, nous reviendrons vers vous rapidement.')
        ->line('Dans l\'attente, nous vous souhaitons une excellente journée.')
        ->line('Cordialement,')
        ->salutation('L\'équipe de recrutement Vala-Orange.');
    }

}
