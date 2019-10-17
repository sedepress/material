<?php

namespace App\Search\MaterialSearch;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class MaterialSearch
{
    public static function apply(Request $filters)
    {
        $query = static::applyDecoratorsFromRequest($filters, Material::query()->with('admin:id,nickname'));

        return $query;
    }

    private static function applyDecoratorsFromRequest(Request $request, Builder $query)
    {
        foreach (array_filter($request->all()) as $filterName => $value) {
            $decorator = static::createFilterDecorator($filterName);

            if (static::isValidDecorator($decorator)) {
                $query = $decorator::apply($query, $value);
            }
        }

        return $query;
    }

    private static function createFilterDecorator($name)
    {
        return __NAMESPACE__ . '\\Filters\\' .
            str_replace(' ', '',
                ucwords(str_replace('_', ' ', $name)));
    }

    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }

    public static function getResults(Builder $query)
    {
        return $query->get();
    }
}
