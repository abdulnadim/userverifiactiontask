<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;






class ForgetPwdLinkNotification extends Notification implements ShouldQueue

{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $token;
    public function __construct($token)
    {
       
        $this->token = $token;
       
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');


        // $url = url('/api/password/find/'.$this->token);
        // return (new MailMessage)
        //     ->line('You are receiving this email because we received a password reset request for your account.')
        //     ->action('Reset Password', url($url))
        //     ->line('If you did not request a password reset, no further action is required.');


            // $url = url('reset_password/' . base64_encode($this->token));
                $url = 'https://mmfinfotech.co/tink/reset_password/'. base64_encode($this->token);

                return (new MailMessage)

                    ->subject(trans('emailNotifications.password_reset_Link'))

                    ->greeting(trans('emailNotifications.email_verification_content_1', ['userName' => $notifiable->first_name]))

                    ->line("\n")

                    ->line(trans('emailNotifications.password_reset_content_1',['Email' => $notifiable->email]))

                    ->action(trans('emailNotifications.password_reset_button'), url($url))
                     //->line(trans('emailNotifications.email_forgot_code', ['code' => $this->token]))
                     
                    //->line(trans('emailNotifications.password_reset_content_2'))

                    ->line("\n")

                    //->line(trans('emailNotifications.password_reset_content_3'))
                 ->line(new HtmlString('<strong>Note:- </strong> Please ignore if you were not requested for a password change request.'))

                    ->line("\n")

                    ->line(trans('emailNotifications.Regards'))

                    ->salutation(config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
