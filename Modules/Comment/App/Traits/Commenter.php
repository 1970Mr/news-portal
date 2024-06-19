<?php

namespace Modules\Comment\App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Comment\App\Models\Comment;

trait Commenter
{
    public function approvedComments(): MorphMany
    {
        return $this->comments()->where('status', Comment::APPROVED);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commenter')->latest();
    }
}
