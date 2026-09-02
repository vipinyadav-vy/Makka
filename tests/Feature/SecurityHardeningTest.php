<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecurityHardeningTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }
    public function test_mobile_user_list_is_accessible_without_bearer_token(): void
    {
        $response = $this->getJson('/api/userList');

        $this->assertNotEquals(401, $response->status());
        $this->assertNotEquals(404, $response->status());
    }

    public function test_sql_injection_in_login_is_treated_as_credentials(): void
    {
        $response = $this->from('/login')->post('/login', [
            'email' => "' OR '1'='1",
            'password' => "' OR 1=1 --",
        ]);

        $response->assertStatus(302);
        $this->assertGuest();
    }

    public function test_password_reset_without_token_is_rejected(): void
    {
        $response = $this->from('/forgot-password')->put('/reset-password', [
            'email' => 'nobody@example.com',
            'password' => 'secret123',
            'confirm_password' => 'secret123',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('token');
    }

    public function test_report_pdf_requires_authentication(): void
    {
        $response = $this->get('/siteInductionReportsPdf/1');

        $response->assertRedirect(route('login'));
    }

    public function test_public_registration_route_is_disabled(): void
    {
        $response = $this->get('/register');

        $this->assertTrue(in_array($response->status(), [404, 405], true) || $response->isRedirect());
        if ($response->isRedirect()) {
            $this->assertFalse(str_contains($response->headers->get('Location') ?? '', '/register'));
        }
    }
}
