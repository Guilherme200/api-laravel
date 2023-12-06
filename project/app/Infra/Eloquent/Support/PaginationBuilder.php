<?php

namespace App\Infra\Eloquent\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginationBuilder
{
    private static Builder $subject;
    protected int $perPage = 20;
    protected JsonResource|null $resource = null;

    public static function for(Model $model): self
    {
        if (is_subclass_of($model, Model::class)) {
            self::$subject = $model::query();
        }

        return new static(self::$subject);
    }

    public function perPage(int $perPage): self
    {
        $this->perPage = $perPage;
        return $this;
    }

    public function filterBy(array $filters): self
    {
        foreach ($filters as $field => $value) {
            self::$subject->where($field, 'like', "$value%");
        }

        return $this;
    }

    public function resource(JsonResource $resource): self
    {
        $this->resource = $resource;
        return $this;
    }

    public function build(): JsonResource
    {
        $paginated = self::$subject->paginate($this->perPage);
        return (!!$this->resource)
            ? $this->resource::collection($paginated)
            : JsonResource::collection($paginated);
    }
}
