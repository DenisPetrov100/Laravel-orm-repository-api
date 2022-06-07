<?php

namespace App\Repository\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    /**
     * @param Request $request
     * @return Collection
     */
    public function search(Request $request): Collection;

    /**
     * @param string $name
     * @return string
     */
    public static function createFilterDecorator(string $name);
}
