<?php

namespace Modules\Comment\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Comment\App\Models\Comment;
use Modules\Comment\App\Services\CommentService;

class CommentController extends Controller
{
    public function __construct(private readonly CommentService $commentService) {}

    public function index(): View
    {
        $comments = Comment::with('commentable')->latest()->paginate(10);
        return view('comment::index', compact(['comments']) + ['commentService' => $this->commentService]);
    }

    public function changeStatus(Request $request, $id): RedirectResponse
    {
        //
    }
}
