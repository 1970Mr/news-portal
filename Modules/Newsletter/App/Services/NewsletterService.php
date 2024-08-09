<?php

namespace Modules\Newsletter\App\Services;

use Illuminate\Http\Request;
use Modules\Newsletter\App\Models\Newsletter;

class NewsletterService
{
    public function index(Request $request)
    {
        $searchText = $request->get('query');
        if ($searchText) {
            $newsletters = Newsletter::search($searchText)->latest()->paginate(10);
        } else {
            $newsletters = Newsletter::query()->latest()->paginate(10);
        }

        return $newsletters;
    }
}
