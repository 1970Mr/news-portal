<?php

namespace Modules\Menu\App\Services;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\Menu\App\Models\Menu;

class MenuService
{
    public function index(Request $request): Paginator
    {
        $searchText = $request->get('query');
        if ($searchText) {
            $menus = $this->search($searchText);
        } else {
            $menus = Menu::with(['parent', 'category'])->latest()->paginate(10);
        }
        return $menus;
    }

    private function search(mixed $searchText): Paginator
    {
        return Menu::search($searchText)->query(static function (Builder $query) use ($searchText) {
            // Search in menus
            $query->orWhereHas('parent', function (Builder $q) use ($searchText) {
                $q->where('name', 'like', "%{$searchText}%")
                    ->orWhere('url', 'like', "%{$searchText}%");
            });
            // Search in categories
            $query->orWhereHas('category', function (Builder $q) use ($searchText) {
                $q->where('name', 'like', "%{$searchText}%");
            });
        })->latest()->paginate(10);
    }
}
