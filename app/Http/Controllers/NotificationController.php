<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Emergency_contact;
use App\Models\User;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Support\Facades\Auth;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function send(Request $request)
{
    $user = Auth::user()->id;
   // Log::debug('Recipient ID: ' . $request->input('recipient_id'));

    $recipient = User::find($user);

    Log::debug('Recipient: ' . print_r($recipient, true));

    if ($recipient) {
        $recipient->notify(new InvoicePaid($request->input('data')));

        return response()->json(['success' => true]);
    } else {
        return response()->json(['error' => 'Recipient not found'], 404);

  }
}


}
