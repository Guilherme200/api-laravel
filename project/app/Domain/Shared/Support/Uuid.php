<?php

namespace App\Domain\Shared\Support;

use Illuminate\Support\Str;

class Uuid
{
    static public function generate(): string
    {
        return Str::uuid()->toString();
    }

}
