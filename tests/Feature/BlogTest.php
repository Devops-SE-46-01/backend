<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Blog;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    protected function setUpUser()
    {
        Blog::create([
            'title' => 'Cara Ternak Lele',
            'description' => 'Cara ternak ikan lele yang baik dan benar',
            'thumbnail' => 'ssst',
            'author' => "Boedi"
        ]);

        Blog::create([
            'title' => 'Cara Ternak Lele 2',
            'description' => 'Cara ternak ikan lele yang baik dan benar 2',
            'thumbnail' => 'ssst',
            'author' => "Agoes"
        ]);
    }

    public function testGetAllBlog()
    {
        $this->setUpUser();
        $response = $this->getJson('/api/blog');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'blog'
            ]);
    }

    public function testGetBlogByAuthor()
    {
        $this->setUpUser();
        $response = $this->getJson('/api/blog?author=Boedi');
        
        $response->assertStatus(200)
            ->assertJsonFragment(['author' => 'Boedi']);
    }

    public function testStoreBlogWithValidFactoryData()
    {
        $blogData = Blog::factory()->make()->toArray();
        $thumbnail = UploadedFile::fake()->image('blog-image.jpg');

        $response = $this->postJson('/api/blog', array_merge($blogData, [
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
            'description' => $blogData['description'],
            'author' => $blogData['author'],
        ]);

        Storage::disk('public')->assertExists('blogs/' . $thumbnail->hashName());
    }

    public function testStoreBlogValidationFailsWithMissingFields()
    {
        $response = $this->postJson('/api/blog', []);

        $response->assertStatus(422);
    }

    public function testUpdateBlogWithThumbnail()
    {
        $this->setUpUser();
        $file = UploadedFile::fake()->image('aaa.jpg')->size(500);

        $response = $this->postJson("/api/blog/1", [
            'title' => 'Updated Title',
            'description' => 'Updated content',
            'thumbnail' => $file,
            'author' => 'Charlie'
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Edit Success']);

        $this->assertDatabaseHas('blogs', [
            'id' => 1,
            'title' => 'Updated Title',
            'description' => 'Updated content',
            'author' => 'Charlie'
        ]);
    }

    public function testUpdateBlogWithLargeSizeThumbnail()
    {
        $this->setUpUser();
        $file = UploadedFile::fake()->image('big.jpg')->size(3000);

        $response = $this->postJson("/api/blog/1", [
            'title' => 'Updated Title',
            'description' => 'Updated content',
            'thumbnail' => $file,
            'author' => 'Charlie'
        ]);

        $response->assertStatus(422);
    }

    public function testDeleteBlog()
    {
        $this->setUpUser();
        
        $response = $this->deleteJson('/api/blog/1');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'message' => 'Blog deleted successfully'
            ]);

        $this->assertDatabaseMissing('blogs', ['id' => 1]);
    }

    public function testDeleteNonExistentBlog()
    {
        $response = $this->deleteJson('/api/blog/999');

        $response->assertStatus(404);
    }
}
