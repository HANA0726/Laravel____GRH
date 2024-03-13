<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Candidat;
class ConfirmationNotification extends Notification
{
    use Queueable;
    private $candidat;

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
        ->subject('Confirmation d\'admission')
        ->greeting('Félicitations '.$notifiable->prenom.',')
        ->line('Nous sommes ravis de vous informer que votre candidature pour le poste de '.$notifiable->poste.' a été retenue.')
        ->line('Votre profil a été jugé correspondre parfaitement à nos attentes et nous sommes convaincus que vous serez un atout majeur pour notre entreprise.')
        ->line('Nous prendrons contact avec vous dans les prochains jours pour vous faire part des détails de votre contrat et convenir d\'une date de début.')
        ->line('Si vous avez des questions, n\'hésitez pas à nous contacter.')
        ->line('Nous vous remercions de votre confiance .')
        ->line('Cordialement,')
        ->salutation('L\'équipe de recrutement Vala-Orange.');
    }


   
}
