<?php

namespace Modules\Comment\App\Services\Front;

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

    public function setCommenter(CommentRequest $request, Comment $comment): Model
    {
        if (!Auth::check()) {
            $comment->setGuestData($request->guest_name, $request->guest_email);
        } else {
            $comment->commenter()->associate(Auth::user());
        }
        return $comment;
    }
}
