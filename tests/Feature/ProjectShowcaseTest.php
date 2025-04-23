<?php

namespace Tests\Feature;

use App\Models\ProjectShowcase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProjectShowcaseTest extends TestCase
{
    private const FIELD_PROJECT_NAME = 'New Name';
    private const FIELD_TEAM_NAME = 'New Team';
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
            'project_name' => self::FIELD_PROJECT_NAME,
            'team_name' => self::FIELD_TEAM_NAME,
            'thumbnail' => $newThumbnail,
        ];

        $response = $this->postJson("/api/project-showcases/{$project->id}", $payload);

        $response->assertOk()
            ->assertJsonFragment([
                'project_name' => self::FIELD_PROJECT_NAME,
                'team_name' => self::FIELD_TEAM_NAME,
            ]);

        $this->assertDatabaseHas('project_showcase', [
            'id' => $project->id,
            'project_name' => self::FIELD_PROJECT_NAME,
            'team_name' => self::FIELD_TEAM_NAME,
        ]);

        Storage::disk('local')->assertExists('thumbnails/' . $newThumbnail->hashName());
    }

    // Test update project showcase with invalid data
    public function testUpdateReturnsValidationErrors()
    {
        Storage::fake('local');
        $project = ProjectShowcase::factory()->create();
    
        $payload = [
            'proposal'  => 'invalid-url',
            'thumbnail' => UploadedFile::fake()->create('file.txt', 100, 'text/plain'),
        ];
    
        $response = $this->postJson("/api/project-showcases/{$project->id}", $payload);
    
        $response->assertStatus(422);
        $this->assertArrayHasKey('errors', $response->json());
        $this->assertArrayHasKey('proposal', $response->json('errors'));
        $this->assertArrayHasKey('thumbnail', $response->json('errors'));
    }
    
    // Test update project showcase with missing id
    public function testUpdateReturnsNotFound()
    {
        $response = $this->postJson('/api/project-showcases/99999', [
            'project_name' => 'Non Existent'
        ]);

        $response->assertNotFound();
    }

    // Test delete project showcase with valid data
    public function testDestroyDeletesProjectShowcase()
    {
        $project = ProjectShowcase::factory()->create();

        $response = $this->deleteJson("/api/project-showcases/{$project->id}");

        $response->assertNoContent();

        $this->assertDatabaseMissing('project_showcase', [
            'id' => $project->id,
        ]);
    }

    // Test delete project showcase with missing id
    public function testDeleteReturnsNotFound   ()
    {
        $response = $this->deleteJson('/api/project-showcases/99999', [
            'project_name' => 'Non Existent'
        ]);

        $response->assertNotFound();
    }
}
