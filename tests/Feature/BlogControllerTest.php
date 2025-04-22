<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BlogControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_blog_with_valid_factory_data()
    {
        Storage::fake('public');

        $blogData = Blog::factory()->make()->toArray();
        $thumbnail = UploadedFile::fake()->image('blog-image.jpg');

        $response = $this->postJson('/api/blogs', array_merge($blogData, [
            'thumbnail' => $thumbnail,
        ]));

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'message' => 'Blog created successfully',
                     'title' => $blogData['title'],
                     'author' => $blogData['author'],
                 ]);

        $this->assertDatabaseHas('blogs', [
            'title' => $blogData['title'],
            'body' => $blogData['body'],
            'author' => $blogData['author'],
        ]);

        Storage::disk('public')->assertExists('blogs/' . $thumbnail->hashName());
    }

    public function test_store_blog_validation_fails_with_factory_missing_fields()
    {
        $response = $this->postJson('/api/blogs', []); // kosong

        $response->assertStatus(422);
    }
}