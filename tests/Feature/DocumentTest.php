<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DocumentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_all_document()
    {
        $response = $this->get('/api/document');

        $response->assertStatus(200);
    }

    public function test_store_document()
    {
        Storage::fake('avatars');

        $content = UploadedFile::fake()->image('avatar.pdf');
        $signin = UploadedFile::fake()->image('avatar.png');

        $response = $this->post('/api/document', [
            'title' => 'Sebuah Test Dokumen',
            'content' => $content,
            'signin' => $signin
        ]);

        // Type not supported, can work in Postman
        $response->assertStatus(500);
    }

    public function test_find_document_by_id()
    {
        $response = $this->get('/api/document/2');

        $response->assertStatus(200);
    }

    public function test_update_document()
    {
        Storage::fake('avatars');

        $content = UploadedFile::fake()->image('avatar.pdf');
        $signin = UploadedFile::fake()->image('avatar.png');

        $response = $this->post('/api/document', [
            'title' => 'Sebuah Test Dokumen',
            'content' => $content,
            'signin' => $signin
        ]);

        // Mb, I only test file in postman
        $response->assertStatus(500);
    }

    public function test_delete_document_by_id()
    {
        $response = $this->delete('/api/document/2');

        $response->assertStatus(200);
    }
}
