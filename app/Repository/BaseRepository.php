<?php

namespace App\Repository;

use App\Repository\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(protected Model $model)
    {
    }

    /**
    * @param $id
    * @return Model
    */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return Collection
     */
    abstract static function createFilterDecorator(string $name);

    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }

    static function applyDecoratorsFromRequest(Request $request, Builder $query)
    {
        foreach ($request->validated() as $filterName => $value) {

            $decorator = static::createFilterDecorator($filterName);

            if (static::isValidDecorator($decorator)) {
                $query = $decorator::apply($query, $value);
            } else {
                abort(400, "Bad parameter: $filterName");
            }
        }
        return $query;
    }
    /**
     * @param Request $request
     * @return Collection
     */
    public function search(Request $filters): Collection
    {
        $query = $this->model->newQuery();
        $query = static::applyDecoratorsFromRequest($filters, $query);
        return $query->get();
    }
}
