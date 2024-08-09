<?php

namespace Modules\Comment\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Laravel\Scout\Searchable;

class Comment extends Model
{
    use Searchable;
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
        'commenter',
    ];

    protected $fillable = [
        'comment',
        'status',
        'guest_data',
    ];

    protected $casts = [
        'approved' => 'boolean',
        'guest_data' => 'array',
    ];

    public static function getAllDescendants(Comment $comment): Collection
    {
        $descendants = collect();

        foreach ($comment->approvedChildren as $child) {
            $descendants->push($child);
            $descendants = $descendants->merge(self::getAllDescendants($child));
        }

        return $descendants->sortBy('created_at');
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'comment' => $this->comment,
        ];
    }

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

    public function delete(): ?bool
    {
        foreach ($this->children as $comment) {
            $comment->delete();
        }

        return parent::delete();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public function approvedParent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id')->approved();
    }

    public function approvedChildren(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id')->approved();
    }

    public function commenterName(): string
    {
        return $this->isGuest() ? $this->getGuestName() : $this->commenter->full_name;
    }

    public function isGuest(): bool
    {
        return (bool) $this->guest_data;
    }

    public function getGuestName(): string
    {
        return $this->guest_data['name'];
    }

    public function commenterImageLink(): string
    {
        return $this->isGuest() ?
            config('user.default_profile_picture.file_link') :
            asset('storage/'.$this->commenter->image->file_path);
    }

    public function getStatus(): string
    {
        return __($this->status);
    }

    public function setStatus($status): void
    {
        $this->status = $status;
        $this->save();
    }

    public function setStatusClass(): string
    {
        return match ($this->status) {
            self::PENDING => 'text-warning',
            self::APPROVED => 'text-success',
            self::REJECTED => 'text-danger',
            default => 'text-muted',
        };
    }

    public function setGuestData(string $name, string $email): Model
    {
        $this->guest_data = [
            'name' => $name,
            'email' => $email,
        ];

        return $this;
    }

    public function scopePending(Builder $query): void
    {
        $query->where('status', self::PENDING);
    }

    public function scopeApproved(Builder $query): void
    {
        $query->where('status', self::APPROVED);
    }

    public function scopeRejected(Builder $query): void
    {
        $query->where('status', self::REJECTED);
    }

    public function isApproved(): bool
    {
        return $this->status === self::APPROVED;
    }
}
