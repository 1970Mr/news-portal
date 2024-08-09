<?php

namespace Modules\RedirectManager\App\Services;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Modules\RedirectManager\App\Models\Redirect;

class RedirectService
{
    public function index(Request $request): Paginator
    {
        $searchText = $request->get('query');
        if ($searchText) {
            $redirects = $this->search($searchText);
        } else {
            $redirects = Redirect::query()->latest()->paginate(10);
        }

        return $redirects;
    }

    private function search(mixed $searchText): Paginator
    {
        return Redirect::search($searchText)->latest()->paginate(10);
    }
}
