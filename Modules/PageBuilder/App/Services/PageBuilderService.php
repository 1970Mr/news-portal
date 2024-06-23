<?php

namespace Modules\PageBuilder\App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\FileManager\App\Services\Image\ImageService;
use Modules\PageBuilder\App\Http\Requests\PageBuilderRequest;
use Modules\PageBuilder\App\Models\Page;

class PageBuilderService
{
    public function __construct(
        private readonly ImageService $imageService
    )
    {
    }

    public function store(PageBuilderRequest $request): Model
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $page = Page::query()->create($data);
        $image = $this->imageService->store($request, altText: $page->title);
        $page->featured_image()->save($image);
        return $page;
    }
}
