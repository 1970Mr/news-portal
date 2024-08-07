<?php

namespace Modules\FileManager\App\Services\Video;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Modules\FileManager\App\Http\Requests\VideoRequest;
use Modules\FileManager\App\Models\Video;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class VideoService
{
    public function store(VideoRequest $request): Model
    {
        Gate::authorize('store', Video::class);
        $video = Video::query()->create($request->validated());
        $this->handleMedia($video, $request);

        return $video;
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

    private function updateVideoDuration(Video $video, Media $media): void
    {
        $videoPath = $media->id.'/'.$media->file_name;
        $ffmpeg = FFMpeg::fromDisk('media_videos')->open($videoPath);
        $durationInSeconds = $ffmpeg->getDurationInSeconds();
        $video->update(['duration' => $durationInSeconds]);
    }

    public function update(VideoRequest $request, Video $video): Model
    {
        Gate::authorize('store', $video);
        $video->update($request->validated());
        $this->handleMedia($video, $request);

        return $video;
    }

    private function updateThumbnailMedia(Video $video): void
    {
        $video->clearMediaCollection('thumbnails');
        $video->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnails');
    }

    public function destroy(Video $video): void
    {
        Gate::authorize('destroy', $video);
        $video->clearMediaCollection('videos');
        $video->clearMediaCollection('thumbnails');
        $video->delete();
    }
}
