<?php

namespace Modules\FileManager\App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Modules\FileManager\App\Services\FileManagerService;
use Modules\User\App\Models\User;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'alt_text',
        'user_id',
    ];

    protected $appends = ['user_name'];

    public const ALL = 'all';
    public const MY_IMAGE = 'my_images';
    public const OTHER_USERS_IMAGE = 'other_users_images';

    public static function filters(): array
    {
        return [
            self::ALL => __('file-manager::filters.all'),
            self::MY_IMAGE => __('file-manager::filters.my_images'),
            self::OTHER_USERS_IMAGE => __('file-manager::filters.other_users_images'),
        ];
    }

    public function delete(): bool|null
    {
        // TODO: Added a check that the file is not used anywhere by checking that there is no data in the relations
        FileManagerService::delete($this->file_path);
        return parent::delete();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->user?->name,
        );
    }

//    public function altText(): Attribute
//    {
//        $fileName = pathinfo($this->file_path, PATHINFO_FILENAME);
//        $fileName = Str::replace(['_', '-'], ' ', $fileName);
//        return Attribute::make(
//            set: fn () => $this->alt_text ?? $fileName,
//        );
//    }

    public function getUri(): string
    {
        return '/storage/' . $this->file_path;
    }
}
