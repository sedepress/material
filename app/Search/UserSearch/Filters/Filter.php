<?php

namespace App\Search\UserSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

interface Filter
{
    public static function apply(Builder $builder, $value);
}
