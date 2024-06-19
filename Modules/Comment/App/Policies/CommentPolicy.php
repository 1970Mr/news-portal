<?php

namespace Modules\Comment\App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Comment\App\Models\Comment;
use Modules\User\App\Models\User;

class CommentPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Comment $comment): bool
    {
        return $user->id === (int)$comment->commenter_id;
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $user->id === (int)$comment->commenter_id;
    }
}
