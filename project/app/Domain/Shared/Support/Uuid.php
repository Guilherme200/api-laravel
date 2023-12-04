<?php

namespace App\Domain\Shared\Support;

use Ramsey\Uuid\Uuid as Uuid4;

class Uuid
{
    static public function generate(): string
    {
        return (string) Uuid4::uuid4();
    }
}
