<?php

namespace Modules\Common\App\Services;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\Comment\App\Models\Comment;

class CommentService
{
    public function getComments(Request $request): Paginator
    {
        $query = Comment::with('commentable')->latest();
        $this->setFilters($request, $query);
        return $query->paginate(10);
    }

    private function setFilters(Request $request, Builder $query): Builder
    {
        $filter = $request->filter;
        return match ($filter) {
            Comment::PENDING => $query->pending(),
            Comment::APPROVED => $query->approved(),
            Comment::REJECTED => $query->rejected(),
            default => $query,
        };
    }
}
