<?php

namespace Modules\Common\App\Helpers;

class FactoryHelper
{
    public static function uniqueValue(string $model, string $column, string $value): string
    {
        $count = 1;
        $originalValue = $value;
        while ($model::where($column, ucfirst($value))->exists()) {
            $value = $originalValue . '-' . $count;
            $count++;
        }
        return $value;
    }
}
