<?php

namespace Modules\FileManager\App\Services\Video;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\FileManager\App\Http\Requests\VideoRequest;
use Modules\FileManager\App\Models\Video;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class VideoService
{
    public function uploadVideo(UploadedFile $file, $name, $user_id = null)
    {
        // Save the video file
        $path = $file->store('videos');

        // Get video details using FFmpeg
        $media = FFMpeg::open(Storage::path($path));

        // Get duration
        $duration = $media->getDurationInSeconds();

        // Generate thumbnail
//        $thumbnailPath = 'thumbnails/' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.jpg';
//        $media->getFrameFromSeconds(1)
//            ->export()
//            ->toDisk('public')
//            ->save($thumbnailPath);

        // Create video record in database
        $videoRecord = Video::create([
            'name' => $name,
            'duration' => $duration,
            'format' => $file->getClientOriginalExtension(),
            'user_id' => $user_id
        ]);

        // Add video to media collection
        $videoRecord->addMedia(Storage::path($path))->toMediaCollection('videos');

        // Add thumbnail to media collection
//        $videoRecord->addMedia(Storage::path('public/' . $thumbnailPath))->toMediaCollection('thumbnails');

        return $videoRecord;
    }

    public function attachVideoToModel(Model $model, Video $video)
    {
        $model->videos()->save($video);
    }

    public function detachVideoFromModel(Model $model, Video $video)
    {
        $model->videos()->find($video->id)->delete();
    }

    public function store(VideoRequest $request): Model
    {
        $video = Video::query()->create($request->validated());

        $media = $video->addMediaFromRequest('video')
            ->toMediaCollection('videos');

        if ($request->hasFile('thumbnail')) {
            $video->addMediaFromRequest('thumbnail')
                ->toMediaCollection('thumbnails');
        }

        // Calculate video duration
        $videoPath = $media->id . '/' . $media->file_name;
        $ffmpeg = FFMpeg::fromDisk('media_videos')->open($videoPath);
        $durationInSeconds = $ffmpeg->getDurationInSeconds();

        // Save the duration in the video model
        $video->update(['duration' => $durationInSeconds]);
        return $video;
    }

    public function destroy(Video $video): void
    {
        $video->clearMediaCollection('videos');
        $video->clearMediaCollection('thumbnails');
        $video->delete();
    }
}
