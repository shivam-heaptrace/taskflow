<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_homepage_redirects_to_files(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/files');
    }

    public function test_file_routes_require_authentication(): void
    {
        $response = $this->get('/files');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_users_can_view_their_files_page(): void
    {
        $response = $this->actingAs(User::factory()->create())->get('/files');

        $response->assertOk()
            ->assertSeeText('My Files')
            ->assertSeeText('Uploaded Files');
    }
}
