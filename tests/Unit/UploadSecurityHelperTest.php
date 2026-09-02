<?php

namespace Tests\Unit;

use Tests\TestCase;

class UploadSecurityHelperTest extends TestCase
{
    public function test_allowed_upload_extension_rejects_php(): void
    {
        $this->assertNull(allowed_upload_extension('php'));
        $this->assertNull(allowed_upload_extension('phtml'));
        $this->assertNull(allowed_upload_extension('../jpg'));
        $this->assertSame('jpg', allowed_upload_extension('jpeg'));
        $this->assertSame('png', allowed_upload_extension('png'));
        $this->assertSame('pdf', allowed_upload_extension('pdf', ['pdf', 'jpg']));
        $this->assertNull(allowed_upload_extension('pdf', ['jpg', 'png']));
    }

    public function test_store_base64_upload_rejects_php_payload(): void
    {
        $dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'makka_upload_test_' . uniqid();
        mkdir($dir);
        $payload = 'data:image/php;base64,' . base64_encode('<?php echo 1;');
        $this->assertNull(store_base64_upload($payload, $dir, '/tmp'));
        $this->assertCount(0, glob($dir . DIRECTORY_SEPARATOR . '*'));
        @rmdir($dir);
    }

    public function test_store_base64_upload_accepts_png(): void
    {
        $dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'makka_upload_test_' . uniqid();
        mkdir($dir);
        $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg==');
        $payload = 'data:image/png;base64,' . base64_encode($png);
        $stored = store_base64_upload($payload, $dir, '/public/images/signatures');
        $this->assertIsArray($stored);
        $this->assertStringEndsWith('.png', $stored['public']);
        $this->assertFileExists($dir . DIRECTORY_SEPARATOR . basename($stored['public']));
        @unlink($dir . DIRECTORY_SEPARATOR . basename($stored['public']));
        @rmdir($dir);
    }
}
