<?php

namespace Modules\Front\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Modules\Tag\App\Models\Tag;

class TagController extends Controller
{
    public function show(Tag $tag): View
    {
        $articles = $tag->articles()->with(['category', 'image', 'approvedComments', 'user',])->paginate(10);
        abort_if($articles->count() < 1, 404);
        return view('front::tag.index',
            compact(['tag', 'articles']));
    }
}
