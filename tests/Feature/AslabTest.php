<?php

namespace Tests\Feature;

use App\Models\Aslab;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AslabTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    public function testCanGetAllAslabs()
    {
        Aslab::factory()->count(3)->create();

        $response = $this->getJson('/api/Aslab');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'aslab',
            ]);
    }

    public function testCanCreateAslabWithImage()
    {
        // Create a fake image file
        $file = UploadedFile::fake()->image('aslab.jpg');

        $data = [
            'name' => 'John Doe',
            'image' => $file,
            'position' => 'Frontend Lab Assistant',
            'social_media' => '@johndoe',
        ];

        $response = $this->postJson('/api/Aslab', $data);

        // Check that the image was stored
        Storage::disk('public')->assertExists($response->json('aslab.image'));

        // Check database
        $this->assertDatabaseHas('aslabs', [
            'name' => 'John Doe',
            'position' => 'Frontend Lab Assistant',
            'social_media' => '@johndoe',
        ]);
    }
    public function test_validation_fails_when_fields_missing()
    {
        $response = $this->postJson('/api/Aslab', []);

        $response->assertStatus(422);
    }

    public function testCanShowAslab()
    {
        $aslab = Aslab::factory()->create();

        $response = $this->getJson('/api/Aslab/' . $aslab->id);

        $response->assertOk()
            ->assertJsonFragment([
                'id' => $aslab->id,
                'name' => $aslab->name,
            ]);
    }

    public function testShowReturnsNotFound()
    {
        $response = $this->getJson('/api/Aslab/99999');

        $response->assertStatus(404);
    }

    public function testCanUpdateAslab()
    {
        $aslab = Aslab::factory()->create();
        $updateData = [
            'name' => 'Updated Name',
            'position' => 'Updated Position',
            'social_media' => '@updatedsocial',
        ];

        $response = $this->putJson('/api/Aslab/' . $aslab->id, $updateData);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'Updated Name',
                'position' => 'Updated Position',
                'social_media' => '@updatedsocial',
            ]);

        $this->assertDatabaseHas('aslabs', $updateData);
    }

    public function testUpdateReturnsNotFound()
    {
        $updateData = [
            'name' => 'Updated Name',
            'position' => 'Updated Position',
        ];

        $response = $this->putJson('/api/Aslab/99999', $updateData);

        $response->assertStatus(404);
    }

    public function testCanDeleteAslab()
    {
        $aslab = Aslab::factory()->create();

        $response = $this->deleteJson('/api/Aslab/' . $aslab->id);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'message' => 'Success delete Asistant Laboratory',
            ]);

        $this->assertDatabaseMissing('aslabs', ['id' => $aslab->id]);
    }

    public function testDeleteReturnsNotFound()
    {
        $response = $this->deleteJson('/api/Aslab/99999');

        $response->assertStatus(404);
    }
}