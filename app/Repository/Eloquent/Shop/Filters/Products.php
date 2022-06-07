<?php

namespace App\Repository\Eloquent\Shop\Filters;

use App\Repository\Eloquent\Enums\Operators;
use Illuminate\Database\Eloquent\Builder;
use App\Repository\Interfaces\FilterInterface;
use ValueError;

class Products implements FilterInterface
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
        if (is_array($value)){
            $arguments = [];
            foreach ($value as $key => $query) {
                $operator =  Operators::is;
                $arr = explode(':', $query);

                if (isset($arr[1])) {
                    try{
                        $operator = constant("App\Repository\Eloquent\Enums\Operators::{$arr[0]}");
                        // dd($oprator);
                    } catch (ValueError $e) {
                        abort(400, "Bad parameter product: $value");
                    }
                    $val = $arr[1];

                } else {
                    $val = $arr[0];
                }

                $arguments[] = [
                    "column" => $key,
                    "operator" => $operator->value,
                    "value" => $val,
                ];
            }
            static::setProductsFilter($builder, $arguments);
        }
        return $builder;
    }

    private static function setProductsFilter(Builder $builder, array $arguments) {

        $builder->whereHas("products", function ($query) use ($arguments) {
            foreach ($arguments as $arg){
                $query->where(...$arg);
            }
            return $query;
        });

        $builder->with(["products" => function ($query) use ($arguments) {
            foreach ($arguments as $arg){
                $query->where(...$arg);
            }
            return $query;
        }]);

        return $builder;
    }
}
