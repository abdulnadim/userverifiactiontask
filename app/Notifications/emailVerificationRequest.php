<?php



namespace App\Notifications;



use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Notifications\Notification;



class emailVerificationRequest extends Notification

{

    use Queueable;

    protected $token;
    protected $email;

    /**

     * Create a new notification instance.

     *

     * @return void

     */

    public function __construct($url)

    {

        $this->url = $url;

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

        
        $url1 = url("/user/email/verifyEmail") .'/'.base64_encode($notifiable->email) .'/'. $this->url;

        return (new MailMessage)

                    ->subject("User Email Verify")
                    ->greeting("Hello! ". $notifiable->name)
                    
                    ->action("Click here to verify", url($url1))
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

