<?php

namespace Tests\Feature;

use App\Models\Aslab;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AslabControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    // Test get all aslabs
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

    // Test store new aslab
    public function testCanCreateAslab()
    {
        $data = [
            'name' => 'Fiona',
            'image' => 'aslab.jpg',
            'position' => 'Backend Lab Assistant',
            'social_media' => '@fionadev',
        ];

        $response = $this->postJson('/api/Aslab', $data);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'Fiona',
                'position' => 'Backend Lab Assistant',
                'social_media' => '@fionadev',
            ]);

        $this->assertDatabaseHas('aslabs', $data);
    }

    // Test get specific aslab
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

    // Test get aslab with invalid id
    public function testShowReturnsNotFound()
    {
        $response = $this->getJson('/api/Aslab/99999');

        $response->assertStatus(404);
    }

}
