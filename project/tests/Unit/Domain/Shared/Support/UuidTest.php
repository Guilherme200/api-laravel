<?php

namespace Tests\Unit\Domain\Shared\Support;

use App\Domain\Shared\Support\Uuid;
use Tests\Cases\TestCaseUnit;

class UuidTest extends TestCaseUnit
{
    public function test_should_generate_uuid(): void
    {
        $uuid = Uuid::generate();
        $invalidUuid = 'not-a-valid-uuid';

        $this->assertTrue($this->isValidUuid($uuid));
        $this->assertFalse($this->isValidUuid($invalidUuid));
    }

    private function isValidUuid(string $uuid): bool
    {
        $pattern = '/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}$/';
        return (bool)preg_match($pattern, $uuid);
    }

}
