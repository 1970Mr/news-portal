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
        $comment = $this->setCommenter($request, $comment);
        $comment->commentable()->associate($model);
        $comment->save();
        return $comment;
    }

    public function setCommenter(CommentRequest $request, $comment): Model
    {
        if (!Auth::check()) {
            $comment->guest_name = $request->guest_name;
            $comment->guest_email = $request->guest_email;
        } else {
            $comment->commenter()->associate(Auth::user());
        }
        return $comment;
    }
}
