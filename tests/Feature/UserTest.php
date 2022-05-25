<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_new_user()
    {
        $this->withoutExceptionHandling();

        $email = $this->faker->unique()->safeEmail();

        $user = $this->json('POST', route('user.register'), [
            'name' => $this->faker->name(),
            'email' => $email,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password_confirmation' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
        ]);

        $user->assertStatus(200);
    }

    public function test_sends_user_token_on_correct_login()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->json('POST', route('user.login'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertStatus(200)
            ->assertJson(static function (AssertableJson $json){
            $json->has('success')
                ->etc();
        });
    }

    public function test_allow_only_logged_in_users(){
        $this->json('GET', route('dashboard'))
            ->assertStatus(401);
    }
}
