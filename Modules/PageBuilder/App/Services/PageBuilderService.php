<?php

namespace Modules\PageBuilder\App\Services;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
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

    public function index(Request $request): Paginator
    {
        $searchText = $request->get('query');
        if ($searchText) {
            $pages = $this->search($searchText);
        } else {
            $pages = Page::query()->latest()->paginate(10);
        }
        return $pages;
    }

    private function search(mixed $searchText): Paginator
    {
        return Page::search($searchText)->query(static function (Builder $query) use ($searchText) {
            // Search in users
            $query->orWhereHas('user', function ($q) use ($searchText) {
                $q->where('full_name', 'like', "%{$searchText}%")
                    ->orWhere('email', 'like', "%{$searchText}%");
            });
        })->latest()->paginate(10);
    }

    public function store(PageBuilderRequest $request): void
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $page = Page::query()->create($data);
        $image = $this->imageService->store($request, altText: $page->title);
        $page->featured_image()->save($image);
    }

    public function update(PageBuilderRequest $request, Page $page): void
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $page->update($data);
        $this->imageService->uploadImageDuringUpdate($request, $page, $page->title);
    }

    public function destroy(Page $page): void
    {
        $this->imageService->destroyWithoutKeyConstraints($page->featured_image);
        $page->delete();
    }
}
