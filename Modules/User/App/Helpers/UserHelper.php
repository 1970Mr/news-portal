<?php

namespace Modules\User\App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\FileManager\App\Models\Image;
use Modules\FileManager\App\Services\FileManagerService;
use Modules\Role\App\Models\Role;
use Modules\User\App\Exceptions\UserCreationFailedException;
use Modules\User\App\Models\User;

class UserHelper
{
    public static function assignAdminRoleToAdminUser(): void
    {
        try {
            DB::beginTransaction();
            $admin_user = self::createAdminUser();
            $admin_role = Role::query()->where('name', Role::ADMIN)->first();
            $admin_user->syncRoles($admin_role);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UserCreationFailedException($e->getMessage());
        }
    }

    public static function createAdminUser(): Model
    {
        $attributes = collect([
            'name' => config('user.admin_name', 'test'),
            'email' => config('user.admin_email'),
            'password' => Hash::make(config('user.admin_password')),
            'email_verified_at' => now(),
        ]);
        $user = User::query()->firstOrCreate(
            $attributes->only('email')->toArray(),
            $attributes->toArray(),
        );
        $profile_picture = self::createDefaultProfilePicture($user->id);
        $user->image()->save($profile_picture);
        return $user;
    }

    public static function createDefaultProfilePicture(int $user_id = null): Model
    {
        $defaultImagePath = config('user.default_profile_picture.file_path');
        $uploadedFile = new UploadedFile($defaultImagePath, basename($defaultImagePath));
        $defaultAltText = 'Default profile picture';
        $uploadedFilePath = FileManagerService::uploadFromFile($uploadedFile);
        return Image::query()->create([
            'file_path' => $uploadedFilePath,
            'alt_text' => $defaultAltText,
            'user_id' => $user_id,
        ]);
    }
}
