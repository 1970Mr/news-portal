<?php

namespace Modules\Comment\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Modules\Article\App\Models\Article;
use Modules\Comment\App\Models\Comment;

class CommentController extends Controller
{
    public function index(): View
    {
        $comments = Comment::with('commentable')->paginate(10);
        return view('comment::index', compact('comments'));
    }

    public function approved(Request $request, $id): RedirectResponse
    {
        //
    }
}
