<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_users_list()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('users.index'));

        $response->assertStatus(200);
        $response->assertSee($user->name);
    }

    public function test_user_can_view_create_form()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('users.create'));

        $response->assertStatus(200);
    }

    public function test_user_can_create_user()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('users.store'), [
            'name' => 'New User',
            'email' => 'new@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', ['email' => 'new@example.com']);
    }

    public function test_user_can_view_edit_form()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $response = $this->actingAs($user)->get(route('users.edit', $otherUser));

        $response->assertStatus(200);
        $response->assertSee($otherUser->name);
    }

    public function test_user_can_update_user()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $response = $this->actingAs($user)->put(route('users.update', $otherUser), [
            'name' => 'Updated Name',
            'email' => $otherUser->email,
        ]);

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', ['id' => $otherUser->id, 'name' => 'Updated Name']);
    }

    public function test_user_can_delete_user()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $response = $this->actingAs($user)->delete(route('users.destroy', $otherUser));

        $response->assertRedirect(route('users.index'));
        $this->assertModelMissing($otherUser);
    }

    public function test_user_cannot_delete_self()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->delete(route('users.destroy', $user));

        $response->assertSessionHas('error');
        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }
}
