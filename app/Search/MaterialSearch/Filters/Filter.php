<?php

namespace App\Search\MaterialSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

interface Filter
{
    public static function apply(Builder $builder, $value);
}
