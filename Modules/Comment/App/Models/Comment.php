<?php

namespace Modules\Comment\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $with = [
        'commenter'
    ];

    protected $fillable = [
        'comment', 'approved', 'guest_name', 'guest_email'
    ];

    protected $casts = [
        'approved' => 'boolean'
    ];

    /**
     * A model who comments
     */
    public function commenter(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * The model that is commented on
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }
}
