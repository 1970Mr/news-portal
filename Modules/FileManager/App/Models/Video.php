<?php

namespace Modules\FileManager\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\FileManager\App\Services\FileManager;
use Modules\User\App\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Video extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'duration',
        'user_id',
        'videoable_id',
        'videoable_type'
    ];

    protected $appends = [
        'thumbnail_url',
        'video_size',
        'video_type',
        'user_full_name'
    ];

    public function videoable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('videos')
            ->useDisk('media_videos')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumb')
                    ->extractVideoFrameAtSecond(2)
                    ->width(320)
                    ->height(240);
            });

        $this
            ->addMediaCollection('thumbnails')
            ->useDisk('media_videos')
            ->singleFile();
    }

    public function getThumbnailUrl(): string
    {
        $thumbnail = $this->getFirstMedia('thumbnails');
        if ($thumbnail) {
            return $thumbnail->getUrl();
        }

        $video = $this->getFirstMedia('videos');
        if ($video) {
            return $video->getUrl('thumb');
        }

        return config('common.default_image.file_link');
    }

    protected function duration(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? gmdate('H:i:s', $value) : __('unknown'),
        );
    }

    protected function userFullName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->user?->full_name ?? __('unknown'),
        );
    }

    protected function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getThumbnailUrl(),
        );
    }

    protected function videoSize(): Attribute
    {
        $size = $this->getFirstMedia('videos')?->size;
        return Attribute::make(
            get: fn() => FileManager::getReadableSize($size),
        );
    }

    protected function videoType(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getFirstMedia('videos')?->mime_type,
        );
    }
}
