<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Illuminate\Http\Request;
use App\Facades\FCM;



class MessageController extends Controller {
    // public function sendNotification($recipientToken) {
    //     // Create a new instance of the Firebase SDK factory
    //     $factory = (new Factory)
    //     ->withServiceAccount('D:\CR\Git_Safely\Git_Safely\Database_safely\safely-aa7d8-firebase-adminsdk-vy98n-2b2b82471b.json')
    //     ->withDatabaseUri('https://safely-aa7d8-default-rtdb.firebaseio.com/');

    //     // Get the messaging service
    //     $messaging = $factory->createMessaging();

    //     // Set the notification data
    //     $notification = Notification::create('New message', 'You have received a new message');

    //     // Create the message
    //     $message = CloudMessage::withTarget('token', $recipientToken)
    //         ->withNotification($notification);

    //     // Send the message
    //     $result = $messaging->send($message);

    //     // Check the result
    //     if ($result->isSuccess()) {
    //         echo 'Notification sent successfully';
    //     } else {
    //         echo 'Failed to send notification: ' . $result->error()->message();
    //     }
    // }


    // public function sendNotification(Request $request)
    // {
    //     $optionBuilder = new OptionsBuilder();
    //     $optionBuilder->setTimeToLive(60);

    //     $notificationBuilder = new PayloadNotificationBuilder($request->title);
    //     $notificationBuilder->setBody($request->message)
    //         ->setSound('default');  

    //     $dataBuilder = new PayloadDataBuilder();
    //     $dataBuilder->addData(['key' => 'value']);

    //     $option = $optionBuilder->build();
    //     $notification = $notificationBuilder->build();
    //     $data = $dataBuilder->build();

    //     $token = $request->token;

    //     $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

    //     return response()->json(['message' => 'Notification sent']);
    // }


    public function sendNotification(Request $request)
    {
    $message = new FCM\getFacadeAccessor();
$message->setNotification(['title' => 'Test', 'body' => 'This is a test notification']);
$message->setData(['key' => 'value']);

$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3VzZXJMb2dpbiIsImlhdCI6MTY4MzQ2MDIxMiwiZXhwIjoxNjgzNDYzODEyLCJuYmYiOjE2ODM0NjAyMTIsImp0aSI6InJnRjRyM25LZk54MjBPY0QiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.ceZ4-OmZfu1jArl8y6SP5sF60O-Pa-CEeU32hptWfRw'; // Recipient's FCM token

$response = FCM::sendTo($token, null, $message);
}
}


// class MessageController extends Controller {
//     public function sendNotification($recipientToken) {
//         $factory = (new Factory)->withServiceAccount(base_path('google-services.json'));
//         $messaging = $factory->createMessaging();

//         $notification = Notification::create('Safely', 'Enta kowayes ya 7abibi');

//         $message = CloudMessage::withTarget('token', $recipientToken)
//         ->withNotification($notification);

//         $result = $messaging->send($message);

//         if ($result->isSuccess()) {
//             echo 'Notification sent successfully';
//         } else {
//             echo 'Failed to send notification: ' . $result->error()->message();
//         }

//     }
// }
