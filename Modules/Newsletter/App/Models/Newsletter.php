<?php

namespace Modules\Newsletter\App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Newsletter extends Model
{
    use Searchable;

    protected $fillable = [
        'email',
        'subscribed_at'
    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => (int)$this->id,
            'email' => $this->email,
        ];
    }
}
