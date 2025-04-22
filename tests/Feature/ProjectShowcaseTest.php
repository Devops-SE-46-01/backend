<?php

namespace Tests\Feature;

use App\Models\ProjectShowcase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProjectShowcaseTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
    }

    // Test update project showcase with valid data
    public function testModifiesExistingProjectShowcase()
    {
        Storage::fake('local');

        $project = ProjectShowcase::factory()->create([
            'project_name' => 'Old Name',
            'team_name' => 'Old Team',
        ]);

        $newThumbnail = UploadedFile::fake()->image('new-thumb.jpg');
        $payload = [
            'project_name' => 'New Name',
            'team_name' => 'New Team',
            'thumbnail' => $newThumbnail,
        ];

        $response = $this->postJson("/api/project-showcases/{$project->id}", $payload);

        $response->assertOk()
            ->assertJsonFragment([
                'project_name' => 'New Name',
                'team_name' => 'New Team',
            ]);

        $this->assertDatabaseHas('project_showcase', [
            'id' => $project->id,
            'project_name' => 'New Name',
            'team_name' => 'New Team',
        ]);

        Storage::disk('local')->assertExists('thumbnails/' . $newThumbnail->hashName());
    }

    // Test update project showcase with invalid data
    public function testUpdateReturnsValidationErrors()
    {
        Storage::fake('local');
        $project = ProjectShowcase::factory()->create();
    
        $payload = [
            'proposal'  => 'invalid-url', // Invalid format
            'thumbnail' => UploadedFile::fake()->create('file.txt', 100, 'text/plain'), // Not image
        ];
    
        $response = $this->postJson("/api/project-showcases/{$project->id}", $payload);
    
        $response->assertStatus(422);
        $this->assertArrayHasKey('errors', $response->json());
        $this->assertArrayHasKey('proposal', $response->json('errors'));
        $this->assertArrayHasKey('thumbnail', $response->json('errors'));
    }
    


    // Test update project showcase with missing id
    public function testUpdateReturns404()
    {
        $response = $this->postJson('/api/project-showcases/99999', [
            'project_name' => 'Non Existent'
        ]);

        $response->assertNotFound();
    }
}
