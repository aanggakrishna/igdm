<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstagramWebhookController extends Controller
{
    public function verify(Request $request)
    {
        $verifyToken = env('INSTAGRAM_VERIFY_TOKEN', 'my_custom_verify_token');

        if ($request->input('hub_mode') === 'subscribe' && 
            $request->input('hub_verify_token') === $verifyToken) {
            return response($request->input('hub_challenge'), 200);
        }

        return response('Forbidden', 403);
    }

    public function handle(Request $request)
    {
        $payload = $request->all();
        \Illuminate\Support\Facades\Log::info('Instagram Webhook Received:', $payload);

        // Check if it's an Instagram event
        if (isset($payload['object']) && $payload['object'] === 'instagram') {
            foreach ($payload['entry'] as $entry) {
                // Iterate over messaging events
                if (isset($entry['messaging'])) {
                    foreach ($entry['messaging'] as $messageEvent) {
                        if (isset($messageEvent['message'])) {
                            \Illuminate\Support\Facades\Log::info('Processing message event', $messageEvent);
                            $this->processMessage($messageEvent);
                        }
                    }
                }
            }
        }

        return response('EVENT_RECEIVED', 200);
    }

    protected function processMessage($event)
    {
        try {
            $senderId = $event['sender']['id'];
            $messageText = $event['message']['text'] ?? '';
            $timestamp = isset($event['timestamp']) ? date("Y-m-d H:i:s", $event['timestamp'] / 1000) : now();

            // Fetch Username
            $userName = $this->fetchUsername($senderId) ?? 'Unknown';

            \Illuminate\Support\Facades\Log::info("Saving message from $senderId ($userName): $messageText");

            // Store in Database
            \App\Models\IgRowMessage::create([
                'user_id' => $senderId,
                'user_name' => $userName,
                'message' => $messageText,
                'timestamp' => $timestamp,
            ]);
            
            \Illuminate\Support\Facades\Log::info("Message saved successfully.");

            // AUTO REPLY
            $this->replyMessage($senderId, "Halo " . $userName);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Error processing message: " . $e->getMessage());
        }
    }

    protected function fetchUsername($senderId)
    {
        $accessToken = config('services.instagram.page_access_token');
        
        if (!$accessToken) {
            \Illuminate\Support\Facades\Log::warning("Page Access Token missing in config.");
            return null; 
        }

        try {
            // Using v19.0 graph api
            $response = \Illuminate\Support\Facades\Http::get("https://graph.facebook.com/v19.0/{$senderId}", [
                'fields' => 'username,name',
                'access_token' => $accessToken,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['username'] ?? $data['name'] ?? null;
            } else {
                \Illuminate\Support\Facades\Log::error("Graph API Error for User Info ($senderId): " . $response->body());
            }
        } catch(\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to fetch username for ID $senderId: " . $e->getMessage());
        }

        return null;
    }

    protected function replyMessage($recipientId, $messageText)
    {
        $accessToken = config('services.instagram.page_access_token');

        try {
            // First, get the Instagram Business Account ID linked to this Page
            $pageResponse = \Illuminate\Support\Facades\Http::get("https://graph.facebook.com/v19.0/me", [
                'fields' => 'instagram_business_account',
                'access_token' => $accessToken,
            ]);

            $igBusinessId = $pageResponse['instagram_business_account']['id'] ?? null;

            if (!$igBusinessId) {
                \Illuminate\Support\Facades\Log::error("No Instagram Business Account linked to this Page.");
                return;
            }

            // Send message using the IG Business ID
            $response = \Illuminate\Support\Facades\Http::post("https://graph.facebook.com/v19.0/{$igBusinessId}/messages?access_token={$accessToken}", [
                'recipient' => ['id' => $recipientId],
                'message' => ['text' => $messageText],
            ]);

            if ($response->successful()) {
                \Illuminate\Support\Facades\Log::info("Auto-reply sent to $recipientId from $igBusinessId");
            } else {
                \Illuminate\Support\Facades\Log::error("Failed to send auto-reply: " . $response->body());
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Exception sending auto-reply: " . $e->getMessage());
        }
    }
}
