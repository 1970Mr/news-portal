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

    public const PENDING = 'pending';
    public const APPROVED = 'approved';
    public const REJECTED = 'rejected';

    public const COMMENT_STATUS = [
        self::PENDING,
        self::APPROVED,
        self::REJECTED,
    ];

    protected $with = [
        'commenter'
    ];

    protected $fillable = [
        'comment', 'approved', 'guest_data'
    ];

    protected $casts = [
        'approved' => 'boolean',
        'guest_data' => 'array',
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

    public function commenterName(): string
    {
        return $this->isGuest() ? $this->getGuestName() : $this->commenter->name;
    }

    public function isGuest(): bool
    {
        return (bool) $this->guest_data;
    }

    public function getGuestName(): string
    {
        return $this->guest_data['name'];
    }

    public function getStatus(): string
    {
        return __($this->status);
    }
}
