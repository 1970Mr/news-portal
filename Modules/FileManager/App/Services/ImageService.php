<?php

namespace Modules\FileManager\App\Services;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\FileManager\App\Http\Requests\ImageRequest;
use Modules\FileManager\App\Models\Image;

class ImageService
{
    public function index(Request $request): Paginator
    {
        $query = Image::query()->latest();
        $query = $this->setFilters($request, $query);
        return $query->paginate(10);
    }

    public function store(ImageRequest $request): Model
    {
        $data = $request->validated();
        $data['file_path'] = FileManagerService::upload( $request->file('image') );
        $data['user_id'] = auth()->id();
        return Image::query()->create($data);
    }

    public function update(ImageRequest $request, image $image): bool
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['file_path'] = FileManagerService::upload($file);
            FileManagerService::delete($image->file_path);
        }
        return $image->update($data);
    }

    private function setFilters(Request $request, Builder $query): Builder
    {
        if ($request->has('filter')) {
            $filter = $request->filter;
            if ($filter === Image::MY_IMAGE) {
                $query->where('user_id', auth()->id());
            } elseif ($filter === Image::OTHER_USERS_IMAGE) {
                $query->where('user_id', '!=', auth()->id());
            }
        }
        return $query;
    }
}
