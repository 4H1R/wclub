<?php

namespace App\Models\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    private function extractId(string $slug): int
    {
        $id = last(explode('-', $slug));

        if (! is_numeric($id)) {
            abort(404);
        }

        return (int) $id;
    }

    /**
     * @return Attribute<string,string>
     */
    protected function slug(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $this->getRouteKey()
        );
    }

    public function getSlugTitle(): string
    {
        return $this->title;
    }

    public function getRouteKey(): string
    {
        return Str::of($this->getSlugTitle().' '.$this->id)
            ->lower()
            ->split('/\s+/')
            ->join('-');
    }

    public function resolveRouteBinding($value, $field = null): ?Model
    {
        return parent::resolveRouteBinding($this->extractId($value), $field);
    }

    public function resolveRouteBindingQuery($query, $value, $field = null): Builder
    {
        return parent::resolveRouteBindingQuery($query, $this->extractId($value), $field);
    }
}
