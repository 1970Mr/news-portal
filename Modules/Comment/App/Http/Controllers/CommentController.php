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
    public function __construct(private readonly CommentService $commentService)
    {
        $this->middleware('can:' . config('permissions_list.COMMENT_INDEX', false))->only('index');
        $this->middleware('can:' . config('permissions_list.COMMENT_SHOW', false))->only('show');
        $this->middleware('can:' . config('permissions_list.COMMENT_APPROVE', false))->only('approve');
        $this->middleware('can:' . config('permissions_list.COMMENT_REJECT', false))->only('reject');
        $this->middleware('can:' . config('permissions_list.COMMENT_DESTROY', false))->only('destroy');
    }

    public function index(Request $request): View
    {
        $comments = $this->commentService->getComments($request);
        $filters = Comment::COMMENT_STATUS;
        $filters[] = 'all';
        return view('comment::index', compact(['comments', 'filters']) + ['commentService' => $this->commentService]);
    }

    public function show(Comment $comment): View
    {
        return view('comment::show', compact('comment') + ['commentService' => $this->commentService]);
    }

    public function approve(Comment $comment): RedirectResponse
    {
        $comment->setStatus(Comment::APPROVED);
        return back()->with(['success' => __('comment::messages.comment_approved')]);
    }

    public function reject(Comment $comment): RedirectResponse
    {
        $comment->setStatus(Comment::REJECTED);
        return back()->with(['success' => __('comment::messages.comment_rejected')]);
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();
        return to_route('admin.comments.index')->with('success', __('entity_deleted', ['entity' => __('comment')]));
    }
}
