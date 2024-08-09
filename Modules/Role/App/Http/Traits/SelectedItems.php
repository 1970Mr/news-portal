<?php

namespace Modules\Role\App\Http\Traits;

use Illuminate\Database\Eloquent\Collection;

trait SelectedItems
{
    public function selectedItems(Collection $items, string $target, ?array $oldValue, $pluckColumn = 'name', $activeClass = 'checked'): string
    {
        $isSelected = ($oldValue && in_array($target, $oldValue, true)) ||
            (! $oldValue && $items->pluck($pluckColumn)->contains($target));

        return $isSelected ? $activeClass : '';
    }
}
