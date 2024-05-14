<?php

namespace Modules\Front\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Modules\User\App\Models\User;

class AuthorController extends Controller
{
    public function __invoke(User $user): View
    {
        $articlesCount = $user->articles()->count();
        $articles = $user->articles()->with(['category', 'image', 'approvedComments'])->paginate(10);
        $commentsCount = $user->approvedComments()->count();
        $socialNetworks = $user->socialNetworks;
        return view('front::author.index',
            compact(['articlesCount', 'articles', 'commentsCount', 'socialNetworks']) + ['author' => $user]);
    }
}
