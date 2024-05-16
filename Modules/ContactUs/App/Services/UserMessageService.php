<?php

namespace Modules\ContactUs\App\Services;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\ContactUs\App\Models\UserMessage;

class UserMessageService
{
    public function getUserMessages(Request $request): Paginator
    {
        $query = UserMessage::with('seen')->latest();
        $this->setFilters($request, $query);
        return $query->paginate(10);
    }

    private function setFilters(Request $request, Builder $query): Builder
    {
        $filter = $request->filter;
        return match ($filter) {
            UserMessage::SEEN => $query->seen(),
            UserMessage::UNSEEN => $query->unseen(),
            default => $query,
        };
    }
}
