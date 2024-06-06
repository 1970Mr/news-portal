<?php

namespace Modules\FileManager\App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Laravel\Scout\Searchable;
use Modules\User\App\Models\User;

class Image extends Model
{
    use Searchable;

    protected $fillable = [
        'file_path',
        'alt_text',
        'user_id',
        'imageable_id',
        'imageable_type',
    ];

    use HasFactory;

    protected $appends = ['user_full_name'];

    public const ALL = 'all';
    public const MY_IMAGE = 'my_images';
    public const OTHER_USERS_IMAGE = 'other_users_images';

    public function toSearchableArray(): array
    {
        return [
            'id' => (int)$this->id,
            'file_path' => $this->file_path,
            'alt_text' => $this->alt_text,
        ];
    }

    public static function filters(): array
    {
        return [
            self::ALL => __('file-manager::filters.all'),
            self::MY_IMAGE => __('file-manager::filters.my_images'),
            self::OTHER_USERS_IMAGE => __('file-manager::filters.other_users_images'),
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userFullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->user?->full_name,
        );
    }

    public function getUri(): string
    {
        return '/storage/' . $this->file_path;
    }

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
