<?php

namespace Modules\FileManager\App\Services\Video;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\FileManager\App\Http\Requests\VideoRequest;
use Modules\FileManager\App\Models\Video;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class VideoService
{
    public function index(Request $request): Paginator
    {
        $searchText = $request->get('query');
        if ($searchText) {
            $videos = $this->search($searchText);
        } else {
            $videos = Video::query()->latest()->paginate(10);
        }
        return $videos;
    }

    private function search(mixed $searchText): Paginator
    {
        return Video::query()->where(static function (Builder $query) use ($searchText) {
            $query->with('media');
            // Search in media
            $query->whereHas('media', function (Builder $q) use ($searchText) {
                $q->where('name', 'like', "%{$searchText}%")
                    ->orWhere('mime_type', 'like', "%{$searchText}%");
            });

            // Search in users
            $query->orWhereHas('user', function ($q) use ($searchText) {
                $q->where('full_name', 'like', "%{$searchText}%")
                    ->orWhere('email', 'like', "%{$searchText}%");
            });
        })->latest()->paginate(10);
    }

    public function store(VideoRequest $request): Model
    {
        $video = Video::query()->create($request->validated());
        $this->handleMedia($video, $request);

        return $video;
    }

    public function update(VideoRequest $request, Video $video): Model
    {
        $video->update($request->validated());
        $this->handleMedia($video, $request);

        return $video;
    }

    public function destroy(Video $video): void
    {
        $video->clearMediaCollection('videos');
        $video->clearMediaCollection('thumbnails');
        $video->delete();
    }

    private function handleMedia(Video $video, VideoRequest $request): void
    {
        if ($request->hasFile('video')) {
            $this->updateVideoMedia($video);
        }

        if ($request->hasFile('thumbnail')) {
            $this->updateThumbnailMedia($video);
        }
    }

    private function updateVideoMedia(Video $video): void
    {
        $video->clearMediaCollection('videos');
        $media = $video->addMediaFromRequest('video')->toMediaCollection('videos');
        $this->updateVideoDuration($video, $media);
    }

    private function updateThumbnailMedia(Video $video): void
    {
        $video->clearMediaCollection('thumbnails');
        $video->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnails');
    }

    private function updateVideoDuration(Video $video, Media $media): void
    {
        $videoPath = $media->id . '/' . $media->file_name;
        $ffmpeg = FFMpeg::fromDisk('media_videos')->open($videoPath);
        $durationInSeconds = $ffmpeg->getDurationInSeconds();
        $video->update(['duration' => $durationInSeconds]);
    }
}
