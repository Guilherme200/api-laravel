<?php

namespace App\Domain\Shared\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

interface PaginationBuilder
{
    public static function for(Model $model): self;

    public function perPage(int $perPage): self;

    public function filterBy(array $filters): self;

    public function resource(JsonResource $resource): self;

    public function build(): JsonResource;
}
