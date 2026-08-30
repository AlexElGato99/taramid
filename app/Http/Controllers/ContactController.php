<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function send(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        try {
            $recipient = config('settings.to_email', config('mail.from.address', 'ste.taramide@gmail.com'));
            Mail::to($recipient)
                ->send(new ContactFormMail($validated));

            return response()->json(['message' => 'Message envoye avec succes.']);
        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de l\'envoi du message.'], 500);
        }
    }
}
