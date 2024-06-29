<?php

namespace Modules\FileManager\App\Services\Video;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

    public function storeVideo(Request $request): Model
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'format' => 'nullable|string|max:255',
            'video' => 'required|file|mimes:mp4,mov,ogg,qt|max:20000',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $video = new Video();
        $video->name = $request->get('name');
        $video->user_id = Auth::id();
        $video->save();

        $video->addMediaFromRequest('video')
            ->toMediaCollection('videos');

        if ($request->hasFile('thumbnail')) {
            $video->addMediaFromRequest('thumbnail')
                ->toMediaCollection('thumbnails');
        }

        return $video;
    }
}
