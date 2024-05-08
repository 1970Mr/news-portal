<?php

namespace Modules\Comment\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\URL;
use Modules\Comment\App\Http\Requests\Front\CommentRequest;
use Modules\Comment\App\Models\Comment;
use Modules\Comment\App\Services\Front\CommentService;
use Spatie\Honeypot\ProtectAgainstSpam;

class CommentController extends Controller
{
    public function __construct(private readonly CommentService $commentService)
    {
        $this->middleware('auth')->except(['store', 'reply']);
        $this->middleware(ProtectAgainstSpam::class)->only('store');
        $this->authorizeResource(Comment::class, 'comment');
    }

    public function store(CommentRequest $request): RedirectResponse
    {
        $this->commentService->store($request);
        return redirect(URL::previous() . '#comments')->with(['success' => __('comment::messages.comment_saved_successfully')]);
    }

    public function update(CommentRequest $request, Comment $comment): RedirectResponse
    {
//        $comment->update(['comment' => $request->comment, 'status' => Comment::PENDING]);
        $comment->update(['comment' => $request->comment]);
        return redirect(URL::previous() . '#comments')->with(['success' => __('comment::messages.comment_updated_successfully')]);
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();
        return redirect(URL::previous() . '#comments')->with(['success' => __('comment::messages.comment_deleted_successfully')]);
    }

    public function reply(CommentRequest $request, Comment $comment): RedirectResponse
    {
        $this->commentService->reply($request, $comment);
        return redirect(URL::previous() . '#comments')->with(['success' => __('comment::messages.comment_saved_successfully')]);
    }
}
