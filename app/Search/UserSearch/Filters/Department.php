<?php

namespace App\Search\UserSearch\Filters;

class Department
{
    public static function apply($builder, $value)
    {
        return $builder->where('department_id', $value);
    }
}
