<?php

namespace Modules\Comment\App\Services;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Modules\Comment\App\Models\Comment;

class CommentService
{
    public function getComments(Request $request): Paginator
    {
        $query = Comment::with('commentable')->latest();
        $this->setFilters($request, $query);
        $searchText = $request->get('query');
        if ($searchText) {
            $commentIds = $this->search($searchText)->pluck('id');
            $query->whereIn('id', $commentIds);

            return $query->paginate(10)->appends('query', $searchText);
        }

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

    private function search(mixed $searchText): Collection
    {
        return Comment::search($searchText)->query(static function (Builder $query) use ($searchText) {
            // Search in commenters
            $query->orWhereHas('commenter', function ($q) use ($searchText) {
                $q->where('full_name', 'like', "%{$searchText}%");
            });

            // Search in parent comments
            $query->orWhereHas('parent', function ($q) use ($searchText) {
                $q->where('id', 'like', "%{$searchText}%");
            });
        })->latest()->get();
    }
}
