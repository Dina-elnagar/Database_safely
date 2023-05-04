<?php

namespace App\Http\Controllers;

require_once 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class MessageController {
    public function sendNotification($recipientToken) {
        // Create a new instance of the Firebase SDK factory
        $factory = (new Factory)
            ->withServiceAccount('C:\Safely_project\Database_safely\safely-aa7d8-firebase-adminsdk-vy98n-c8334b4408.json')
            ->withDatabaseUri('https://safely-aa7d8-default-rtdb.firebaseio.com/');

        // Get the messaging service
        $messaging = $factory->createMessaging();

        // Set the notification data
        $notification = Notification::create('New message', 'You have received a new message');

        // Create the message
        $message = CloudMessage::withTarget('token', $recipientToken)
            ->withNotification($notification);

        // Send the message
        $result = $messaging->send($message);

        // Check the result
        if ($result->isSuccess()) {
            echo 'Notification sent successfully';
        } else {
            echo 'Failed to send notification: ' . $result->error()->message();
        }
    }
}
