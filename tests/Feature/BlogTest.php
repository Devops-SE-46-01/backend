<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Blog;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;

class BlogTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */

    use DatabaseTransactions;

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

        $response->assertStatus(200);
    }

    public function testGetBlogByAuthor()
    {

        $this->setUpUser();
        $response = $this->getJson('/api/blog?author=Boedi');
        $response->assertStatus(200)
            ->assertJsonFragment(['author' => 'Boedi']);
    }

    public function testUpdateBlogWithThumbnail()
    {
        Storage::fake('public');
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
    }

    public function testUpdateBlogWithLargeSizeThumbnail()
    {
        Storage::fake('public');
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
}
