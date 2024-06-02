<?php

namespace Modules\Common\App\Helpers;

class FactoryHelper
{
    private static array $uniqueValues = [];

    public static function uniqueValue(string $model, string $column, string $value): string
    {
        $originalValue = $value;
        $count = 1;

        while (self::isDuplicate($model, $column, $value)) {
            $value = $originalValue . '-' . $count;
            $count++;
        }

        // Add the unique value to the list
        self::$uniqueValues[$model][$column][] = $value;

        return $value;
    }

    private static function isDuplicate(string $model, string $column, string $value): bool
    {
        // Check the static uniqueValues list
        if (
            isset(self::$uniqueValues[$model][$column]) &&
            in_array($value, self::$uniqueValues[$model][$column])
        ) {
            return true;
        }

        // Check the database
        return $model::where($column, $value)->exists();
    }
}
