<?php

namespace Modules\FileManager\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\User\App\Models\User;
use Spatie\MediaLibrary\InteractsWithMedia;

class Video extends Model
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'duration',
        'format',
        'thumbnail',
        'user_id',
        'videoable_id',
        'videoable_type'
    ];

    public function videoable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
