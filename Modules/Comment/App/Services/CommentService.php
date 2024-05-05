<?php

namespace Modules\Comment\App\Services;

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

    public function setStatusClass(string $status): string
    {
        return match ($status) {
            Comment::PENDING => 'text-warning',
            Comment::APPROVED => 'text-success',
            Comment::REJECTED => 'text-danger',
            default => 'text-muted',
        };
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
