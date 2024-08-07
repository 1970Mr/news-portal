<?php

namespace Modules\User\App\Services;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Modules\FileManager\App\Services\Image\ImageService;
use Modules\User\App\Http\Requests\UserStoreRequest;
use Modules\User\App\Http\Requests\UserUpdateRequest;
use Modules\User\App\Models\User;

class UserService
{
    public function __construct(
        private readonly ImageService $imageService
    ) {}

    public function index(Request $request): Paginator
    {
        $searchText = $request->get('query');
        if ($searchText) {
            $users = $this->search($searchText);
        } else {
            $users = User::query()->latest()->paginate(10);
        }

        return $users;
    }

    private function search(mixed $searchText): Paginator
    {
        return User::search($searchText)->query(static function (Builder $query) use ($searchText) {
            // Search in roles
            $query->orWhereHas('roles', function ($q) use ($searchText) {
                $q->where('name', 'like', "%{$searchText}%")
                    ->orWhere('local_name', 'like', "%{$searchText}%");
            });
        })->latest()->paginate(10);
    }

    public function store(UserStoreRequest $request): void
    {
        $data = $request->validated();
        $request->merge(['alt_text' => 'User Profile Picture']);
        $user = User::create($data);
        $profile_picture = $this->imageService->store($request, 'picture', $user->full_name);
        $user->image()->save($profile_picture);
        if ($request->email_verification) {
            $user->markEmailAsVerified();
        }
    }

    public function update(UserUpdateRequest $request, User $user): void
    {
        $data = $request->validated();
        $this->imageService->uploadImageDuringUpdate($request, $user, $user->full_name);
        $user->update($data);
        $this->checkEmailAsVerified($request, $user);
    }

    private function checkEmailAsVerified(UserUpdateRequest $request, User $user): void
    {
        ($request->email_verification) ?
            $user->markEmailAsVerified() :
            $user->unmarkEmailAsVerified();
    }

    public function delete(User $user): void
    {
        Gate::authorize('delete', $user);
        $this->imageService->destroyWithoutKeyConstraints($user->image);
        $user->delete();
    }
}
