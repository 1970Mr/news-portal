<?php

namespace Modules\Comment\App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\Comment\App\Http\Requests\Front\CommentRequest;
use Modules\Comment\App\Models\Comment;

class CommentService
{
    public function store(CommentRequest $request): Model
    {
        $model = $request->commentable_type::findOrFail($request->commentable_id);
        $comment = Comment::make([ 'comment' => $request->comment ]);
        $this->setCommenter($request, $comment);
        $comment->commentable()->associate($model);
        $comment->save();
        return $comment;
    }

    public function setCommenter(CommentRequest $request, Comment $comment): void
    {
        if (!Auth::check()) {
            $this->setGuestData($request, $comment);
        } else {
            $comment->commenter()->associate(Auth::user());
        }
    }

    public function setStatusClass(string $status): string
    {
        return match ($status) {
            Comment::PENDING => 'text-warning',
            Comment::APPROVED => 'text-success',
            Comment::REJECTED => 'text-danger',
            default => 'text-muted',
        };
    }

    public function setGuestData(CommentRequest $request, $comment): Model
    {
        $comment->guest_data = [
            'name' => $request->guest_name,
            'email' => $request->guest_email,
        ];
        return $comment;
    }
}
