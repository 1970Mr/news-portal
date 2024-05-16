<?php

namespace Modules\Seen\App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Seen\App\Models\Seen;

trait HasSeen
{
    public function seen(): MorphOne
    {
        return $this->morphOne(Seen::class, 'seenable');
    }

    public function markAsSeen(): void
    {
        $this->seen()->updateOrCreate([], ['seen' => true]);
    }

    public function markAsUnseen(): void
    {
        $this->seen()->updateOrCreate([], ['seen' => false]);
    }

    public function isSeen(): bool
    {
        return $this->seen ? $this->seen->seen : false;
    }

    public function getSeenStatus(): string
    {
        return ($this->isSeen()) ? __('seen') : __('unseen');
    }
}
