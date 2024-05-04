<?php

namespace Modules\Comment\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
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
