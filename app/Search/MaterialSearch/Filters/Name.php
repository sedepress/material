<?php

namespace App\Search\MaterialSearch\Filters;

class Name
{
    public static function apply($builder, $value)
    {
        return $builder->where('name', 'like', '%' . $value . '%');
    }
}
