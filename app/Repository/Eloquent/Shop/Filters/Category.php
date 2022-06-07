<?php

namespace App\Repository\Eloquent\Shop\Filters;

use App\Repository\Eloquent\Enums\Operators;
use Illuminate\Database\Eloquent\Builder;
use App\Repository\Interfaces\FilterInterface;
use ValueError;

class Category implements FilterInterface
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value)
    {
        if (is_array($value)) {
            $arguments = [];
            foreach ($value as $key => $query) {
                $operator =  Operators::is;
                $arr = explode(':', $query);

                if (isset($arr[1])) {
                    try {
                        $operator = constant("App\Repository\Eloquent\Enums\Operators::{$arr[0]}");
                    } catch (ValueError $e) {
                        abort(400, "Bad parameter product: $value");
                    }
                    $val = $arr[1];
                } else {
                    $val = $arr[0];
                }

                $arguments[] = [
                    "column" => 'category',
                    "operator" => $operator->value,
                    "value" => $val,
                ];
            }
            static::setCategoryFilter($builder, $arguments);
        }
        return $builder;
    }

    private static function setCategoryFilter(Builder $builder, array $arguments)
    {
        if (count($arguments)) {
            $builder->where(...reset($arguments));
            unset($arguments[0]);

            foreach ($arguments as $arg) {
                $builder->orWhere(...$arg);
            }
        }

        return $builder;
    }
}
