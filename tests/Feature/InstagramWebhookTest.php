<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class InstagramWebhookTest extends TestCase
{
    use RefreshDatabase;

    public function test_verify_webhook_success()
    {
        $verifyToken = 'test_token';
        
        // Mock env if possible or just use a known token locally?
        // Ideally we should mock the config or env, but for simple test:
        // Let's assume the controller uses env('INSTAGRAM_VERIFY_TOKEN') which defaults to 'my_custom_verify_token'
        // We will try with the default.
        
        $response = $this->get('/webhook/instagram?hub_mode=subscribe&hub_verify_token=my_custom_verify_token&hub_challenge=12345');

        $response->assertStatus(200);
        $response->assertSee('12345');
    }

    public function test_verify_webhook_fail()
    {
        $response = $this->get('/webhook/instagram?hub_mode=subscribe&hub_verify_token=wrong_token&hub_challenge=12345');

        $response->assertStatus(403);
    }

    public function test_handle_incoming_message()
    {
        // Mock ENV
        config(['services.instagram.page_access_token' => 'test_access_token']); // Ideal way if using config()
        // But code uses env(). 
        // We really should use config files.
        // For now, let's just make the test pass by bypassing the check or ensuring env is read.
        // Actually, putenv works for env().
        putenv('INSTAGRAM_PAGE_ACCESS_TOKEN=test_access_token');
        
        Http::fake([
            'graph.facebook.com/*' => Http::response(['username' => 'test_user'], 200),
        ]);

        $payload = [
            'object' => 'instagram',
            'entry' => [
                [
                    'messaging' => [
                        [
                            'sender' => ['id' => '123456'],
                            'message' => ['text' => 'Hello World'],
                            'timestamp' => 1672531200000 // 2023-01-01
                        ]
                    ]
                ]
            ]
        ];

        $response = $this->postJson('/webhook/instagram', $payload);

        $response->assertStatus(200);

        $this->assertDatabaseHas('ig_row_messages', [
            'user_id' => '123456',
            'user_name' => 'test_user', // Mocked response
            'message' => 'Hello World',
        ]);
    }
}
