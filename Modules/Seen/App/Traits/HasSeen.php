<?php

namespace Modules\Seen\App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Seen\App\Models\Seen;

trait HasSeen
{
    public function markAsSeen(): void
    {
        $this->seen()->updateOrCreate([], ['seen' => true]);
    }

    public function seen(): MorphOne
    {
        return $this->morphOne(Seen::class, 'seenable');
    }

    public function markAsUnseen(): void
    {
        $this->seen()->updateOrCreate([], ['seen' => false]);
    }

    public function getSeenStatus(): string
    {
        return ($this->isSeen()) ? __('seen') : __('unseen');
    }

    public function isSeen(): bool
    {
        return $this->seen ? $this->seen->seen : false;
    }

    public function scopeUnseen(Builder $query): Builder
    {
        return $query->whereDoesntHave('seen', function (Builder $q) {
            $q->where('seen', true);
        });
    }

    public function scopeSeen(Builder $query): Builder
    {
        return $query->whereHas('seen', function (Builder $q) {
            $q->where('seen', true);
        });
    }
}
