<?php

namespace Modules\Newsletter\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Newsletter extends Model
{
    use SoftDeletes, Searchable;

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
