<?php

namespace App\Repository\Eloquent;

use App\Models\Product;
use App\Repository\BaseRepository;
use App\Repository\Interfaces\BaseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProductRepository extends BaseRepository implements BaseRepositoryInterface
{
    /**
     * ProductRepository constructor.
     *
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return Collection
     */
    public function all(Request $request): Collection
    {
        return $this->model->all();
    }
    /**
     * @param string $name
     * @return string
     */
    public static function createFilterDecorator(string $name)
    {
        return __NAMESPACE__ . '\\Shop\\Filters\\' . Str::studly($name);
    }
}
