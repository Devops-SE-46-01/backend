<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Blog;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class BlogTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */



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

    public function test_get_all_blog()
    {

        $this->setUpUser();
        $response = $this->getJson('/api/blog');

        $response->assertStatus(200);
    }

    public function test_get_blog_by_author()
    {

        $this->setUpUser();
        $response = $this->getJson('/api/blog?author=Boedi');
        $response->assertStatus(200)
            ->assertJsonFragment(['author' => 'Boedi']);
    }

    public function test_update_blog_with_thumbnail()
    {
        Storage::fake('public');
        $this->setUpUser();

        $file = UploadedFile::fake()->image('aaa.jpg')->size(500);

        $response = $this->postJson("/api/blog/1", [
            'title' => 'Updated Title',
            'content' => 'Updated content',
            'thumbnail' => $file,
            'author' => 'Charlie'
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Edit Success']);
    }

    public function test_update_blog_with_large_size_thumbnail()
    {
        Storage::fake('public');
        $this->setUpUser();

        $file = UploadedFile::fake()->image('big.jpg')->size(3000);

        $response = $this->postJson("/api/blog/1", [
            'title' => 'Updated Title',
            'content' => 'Updated content',
            'thumbnail' => $file,
            'author' => 'Charlie'
        ]);

        $response->assertStatus(422)
            ->assertJsonFragment(['message' => 'Image Size Exceed 2MB']);
    }
}
