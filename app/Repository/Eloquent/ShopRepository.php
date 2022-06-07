<?php

namespace App\Repository\Eloquent;

use App\Models\Shop;
use App\Repository\BaseRepository;
use App\Repository\Interfaces\BaseRepositoryInterface;
use Illuminate\Support\Str;
class ShopRepository extends BaseRepository implements BaseRepositoryInterface
{
    /**
     * ShopRepository constructor.
     *
     * @param Shop $model
     */
    public function __construct(Shop $model)
    {
        parent::__construct($model);
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
