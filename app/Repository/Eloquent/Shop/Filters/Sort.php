<?php

namespace App\Repository\Eloquent\Shop\Filters;

use Illuminate\Database\Eloquent\Builder;
use App\Repository\Interfaces\FilterInterface;
use App\Repository\Eloquent\Enums\SortOrder;
use ValueError;

class Sort implements FilterInterface
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
            foreach ($value as $val) static::setOrder($builder, (string)$val);
        } elseif (is_string($value)) {
            static::setOrder($builder, $value);
        }

        return $builder;
    }

    private static function setOrder(Builder $builder, string $value) {
        $order =  SortOrder::Asc;
        $arr = explode(',',$value);
        $sort = $arr[0];

        if (isset($arr[1])) {
            try{
                $order = SortOrder::from($arr[1]);
            } catch (ValueError $e) {
                abort(400, "Bad parameter sort order: $value");
            }
        }

        $builder->orderBy($sort, $order->value);
    }
}
