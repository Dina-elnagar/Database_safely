<?php

namespace App\Notifications;

use App\Models\Emergency_contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use Twilio\Rest\Client;
use Illuminate\Notifications\Messages\VonageMessage;

class EmergencyNotification extends Notification
{
    use Queueable;
    // protected $user;
    // protected $emergencyContact;
    //protected $message;

    // public function __construct($message)
    // {
    //     $this->message = $message;
    // }
    public function via($notifiable)
    {
        return ['vonage'];
    }

    public function toVonage($notifiable)
    {
        return (new VonageMessage)
        ->content('This is an emergency notification.');
           // ->content($this->message);
    }
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    // public function __construct(User $user, Emergency_contact $emergencyContact)
    // {
    //     $this->user = $user;
    //     $this->emergencyContact = $emergencyContact;
    // }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // public function via($notifiable)
    // {
    //     return ['sms'];
    // }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }
    // public function toSms($notifiable)
    // {
    //     // Define the content of the SMS message here, including the user's location and a message indicating that they haven't responded.
    //     $sid    = config('services.twilio.account_sid');
    //     $token  = config('services.twilio.auth_token');
    //     $twilio = new Client($sid, $token);
    //     $message = "Emergency notification for " . $this->user->first_name . ": " . "Please check on me, I am in danger. My location is ";// . $this->user->location;
    //     // Return an array containing the SMS message content and the recipient's phone number.
    //     return [
    //         // Define the content of the SMS message and the recipient's phone number.
    //         $message = "User with ID {$this->user->id} has not responded to the notification.",
    //         $to = $this->emergencyContact->phone_number,

    //         // Use the Twilio API to send the SMS message.
    //         $twilio = new Client(config('services.twilio.account_sid'), config('services.twilio.auth_token')),
    //         $twilio->messages->create($to, [
    //             'from' => config('services.twilio.from'),
    //             'body' => $message,
    //         ]),

    //     ];
    // }

//     public function toSms($notifiable)
// {
//     $sid = config('services.twilio.account_sid');
// $token = config('services.twilio.auth_token');
// $twilio = new Twilio\Rest\Client($sid, $token);

//     $message = new \Illuminate\Notifications\Messages\TwilioMessage();
//     $message->content('Emergency notification for ' . $this->user->first_name . ': Please check on me, I am in danger. My location is ' . $this->user->last_name);
//     $message->from(config('services.twilio.from'));
//     $message->to($this->emergencyContact->phone_number);
//     return $message;
// }

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
