<?php

namespace Modules\Front\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Modules\SEOManager\App\Services\Front\SEOService;
use Modules\Tag\App\Models\Tag;

class TagController extends Controller
{
    public function __construct(private readonly SEOService $SEOService) {}

    public function show(Tag $tag): View
    {
        $this->SEOService->setTagPageSEO($tag);
        $articles = $tag->articles()->with(['category', 'image', 'approvedComments', 'user'])->paginate(10);

        return view(
            'front::tag.index',
            compact(['tag', 'articles'])
        );
    }
}
