<?php

namespace Modules\RedirectManager\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Redirect extends Model
{
    use SoftDeletes, Searchable;

    protected $fillable = [
        'source_url',
        'destination_url',
        'status_code',
        'status',
    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => (int)$this->id,
            'source_url' => $this->source_url,
            'destination_url' => $this->destination_url,
            'status_code' => $this->status_code,
        ];
    }
}
