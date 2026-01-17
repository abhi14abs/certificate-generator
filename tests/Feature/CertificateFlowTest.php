<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Certificate;

class CertificateFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_loads()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Certificate Generator');
    }

    public function test_preview_loads_with_valid_data()
    {
        $response = $this->post('/preview', [
            'candidate_name' => 'John Doe',
            'domain' => 'Software Engineering',
            'type' => 'Internship',
            'layout_type' => 'classic',
            'logos' => ['iso', 'msme'],
            'heading' => 'Certificate of Intern',
            'signature' => 'ceo',
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('certificate.preview_v2'); // V2 View
        $response->assertSee('John Doe');
        $response->assertSee('Software Engineering');
        $response->assertSee('For successfully completing the Internship program'); // Auto-generated content

        // Ensure NOT saved yet
        $this->assertDatabaseCount('certificates', 0);
    }

    public function test_download_saves_and_returns_pdf()
    {
        $response = $this->post('/download', [
            'candidate_name' => 'Jane Smith',
            'domain' => 'Data Science',
            'type' => 'Offer Letter',
            'layout_type' => 'modern',
            'heading' => 'Offer Letter',
            'signature' => 'hr',
            'logos' => ['startup'],
        ]);

        $response->assertStatus(200);

        // Assert it's a PDF download
        $response->assertHeader('content-type', 'application/pdf');

        // Assert saved in DB
        $this->assertDatabaseCount('certificates', 1);
        $this->assertDatabaseHas('certificates', [
            'candidate_name' => 'Jane Smith',
            'domain' => 'Data Science',
            // Content should be auto-generated
        ]);

        // Check if content was generated for Offer Letter
        $cert = Certificate::where('candidate_name', 'Jane Smith')->first();
        $this->assertStringContainsString('We are pleased to offer you', $cert->content);
    }
}
