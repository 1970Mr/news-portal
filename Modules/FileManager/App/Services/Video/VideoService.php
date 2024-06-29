<?php

namespace Modules\FileManager\App\Services\Video;

use Illuminate\Database\Eloquent\Model;
use Modules\FileManager\App\Http\Requests\VideoRequest;
use Modules\FileManager\App\Models\Video;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class VideoService
{
    public function store(VideoRequest $request): Model
    {
        $video = Video::query()->create($request->validated());

        $media = $video->addMediaFromRequest('video')->toMediaCollection('videos');

        if ($request->hasFile('thumbnail')) {
            $video->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnails');
        }

        // Calculate video duration
        $videoPath = $media->id . '/' . $media->file_name;
        $ffmpeg = FFMpeg::fromDisk('media_videos')->open($videoPath);
        $durationInSeconds = $ffmpeg->getDurationInSeconds();
        $video->update(['duration' => $durationInSeconds]);

        return $video;
    }

    public function update(VideoRequest $request, Video $video): Model
    {
        $video->update($request->validated());

        if ($request->hasFile('video')) {
            $video->clearMediaCollection('videos');
            $media = $video->addMediaFromRequest('video')
                ->toMediaCollection('videos');

            // Calculate video duration
            $videoPath = $media->id . '/' . $media->file_name;
            $ffmpeg = FFMpeg::fromDisk('media_videos')->open($videoPath);
            $durationInSeconds = $ffmpeg->getDurationInSeconds();
            $video->update(['duration' => $durationInSeconds]);
        }

        if ($request->hasFile('thumbnail')) {
            $video->clearMediaCollection('thumbnails');
            $video->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnails');
        }

        return $video;
    }

    public function destroy(Video $video): void
    {
        $video->clearMediaCollection('videos');
        $video->clearMediaCollection('thumbnails');
        $video->delete();
    }
}
