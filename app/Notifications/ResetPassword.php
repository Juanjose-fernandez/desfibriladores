<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;

    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Reseteo de contraseña')
            ->greeting('Hola!')
            ->line('Has recibido este email por que hemos recibido una petición de reseteo de contraseña')
            ->action('Resetear Contraseña',route('password.reset', $this->token))
            ->line('Si no has solicitado el reseteo, por favor no haga ninguna acción.')
            ->line('Para cualquier consulta estamos a su disposición en esforem@soporte.es');
    }
}
