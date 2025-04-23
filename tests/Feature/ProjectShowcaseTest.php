<?php

namespace Tests\Feature;

use App\Models\ProjectShowcase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProjectShowcaseTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test constants to avoid duplication
     */
    private const TEST_PROJECT_NAME = 'Test Project';
    private const TEST_TEAM_NAME = 'Test Team';

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
    }

    // Test listing all project showcases
    public function testIndexReturnsListOfProjectShowcases()
    {
        // Create multiple project showcases
        $projects = ProjectShowcase::factory()->count(3)->create();

        $response = $this->getJson('/api/project-showcases');

        $response->assertOk()
            ->assertJson([
                'status' => 'success',
                'message' => 'Projects retrieved successfully'
            ]);

        // Verify the response contains the projects
        $this->assertCount(3, $response->json('data'));
    }

    // Test storing a new project showcase with valid data
    public function testStoreCreatesNewProjectShowcase()
    {
        Storage::fake('public');

        $thumbnail = UploadedFile::fake()->image('project.jpg');
        $qrCode = UploadedFile::fake()->image('qr.jpg');

        $payload = [
            'project_name' => self::TEST_PROJECT_NAME,
            'team_name' => self::TEST_TEAM_NAME,
            'team_members' => 'John Doe, Jane Doe',
            'about' => 'This is a test project description',
            'proposal' => 'https://example.com/proposal',
            'prd' => 'https://example.com/prd',
            'figma' => 'https://example.com/figma',
            'github' => 'https://github.com/test/project',
            'design_system' => 'https://example.com/design',
            'thumbnail' => $thumbnail,
            'qr' => $qrCode
        ];

        $response = $this->postJson('/api/project-showcases', $payload);

        $response->assertStatus(201)
            ->assertJson([
                'status' => 'success',
                'message' => 'Project created successfully'
            ]);

        // Verify it was stored in the database
        $this->assertDatabaseHas('project_showcase', [
            'project_name' => self::TEST_PROJECT_NAME,
            'team_name' => self::TEST_TEAM_NAME,
            'team_members' => 'John Doe, Jane Doe',
            'about' => 'This is a test project description',
            'proposal' => 'https://example.com/proposal',
        ]);

        // Verify files were stored
        Storage::disk('public')->assertExists('thumbnails/' . $thumbnail->hashName());
        Storage::disk('public')->assertExists('qr_codes/' . $qrCode->hashName());
    }

    // Test storing a project showcase with invalid data
    public function testStoreReturnsValidationErrors()
    {
        $payload = [
            // Missing required fields
            'project_name' => self::TEST_PROJECT_NAME,
            'proposal' => 'not-a-url', // Invalid URL
        ];

        $response = $this->postJson('/api/project-showcases', $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['team_name', 'team_members', 'about', 'proposal']);
    }

    // Test retrieving a specific project showcase
    public function testShowReturnsProjectShowcase()
    {
        $project = ProjectShowcase::factory()->create([
            'project_name' => 'Specific Project',
            'team_name' => 'Specific Team',
        ]);

        $response = $this->getJson("/api/project-showcases/{$project->id}");

        $response->assertOk()
            ->assertJson([
                'status' => 'success',
                'message' => 'Project retrieved successfully',
                'data' => [
                    'project_name' => 'Specific Project',
                    'team_name' => 'Specific Team',
                ]
            ]);
    }

    // Test retrieving a non-existent project showcase
    public function testShowReturnsNotFoundForInvalidId()
    {
        $response = $this->getJson('/api/project-showcases/99999');

        $response->assertNotFound()
            ->assertJson([
                'status' => 'error',
                'message' => 'Project not found'
            ]);
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
    public function testDeleteReturns()
    {
        $response = $this->deleteJson('/api/project-showcases/99999', [
            'project_name' => 'Non Existent'
        ]);

        $response->assertNotFound();
    }
}
