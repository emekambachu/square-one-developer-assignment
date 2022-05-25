<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_creates_new_post(){

        $this->withoutExceptionHandling();

        $title = $this->faker->sentence;
        $user = User::factory(User::class)->create();

        $this->actingAs($user)->json('POST', route('post.store'), [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'title' => $title,
            'slug' => str::slug($title),
            'description' => $this->faker->text($maxNbChars = 300),
            'publication_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'published' => 1,
        ])->assertStatus(200);
    }
}
