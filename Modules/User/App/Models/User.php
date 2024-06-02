<?php

namespace Modules\User\App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
 use Illuminate\Database\Eloquent\Casts\Attribute;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Relations\HasMany;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Foundation\Auth\User as Authenticatable;
 use Illuminate\Notifications\Notifiable;
 use Illuminate\Support\Collection;
 use Illuminate\Support\Facades\DB;
 use Laravel\Sanctum\HasApiTokens;
 use Modules\Article\App\Models\Article;
 use Modules\Comment\App\Traits\Commenter;
 use Modules\FileManager\App\Traits\HasImage;
 use Modules\Role\App\Models\Role;
 use Modules\SocialNetwork\App\Traits\HasSocialNetwork;
 use Modules\User\Database\Factories\UserFactory;
 use Spatie\Permission\Traits\HasRoles;

 class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes, HasImage, Commenter, HasSocialNetwork;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'username',
        'email',
        'about',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = [
      'verified_email_status'
    ];

    public function unmarkEmailAsVerified(): bool
    {
        return $this->forceFill([
            'email_verified_at' => null,
        ])->save();
    }

    protected function verifiedEmailStatus(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->email_verified_at ? __('confirmed') : __('not_confirmed'),
        );
    }

     public function getRoleLocalNames(): Collection
     {
         return $this->roles()->latest()->get()->pluck('local_name');
     }

     public function isAdmin(): bool
     {
         return $this->roles()->first()->name === Role::ADMIN ||
             $this->hasAllPermissions(config('permissions_list.SUPER_ADMIN', false));
     }

     public function role(): \Spatie\Permission\Models\Role
     {
         return $this->roles()->first();
     }

     public function Articles(): HasMany
     {
         return $this->hasMany(Article::class, 'user_id')->active()->published();
     }

     protected static function boot(): void
     {
         parent::boot();

         static::deleting(static function ($user) {
             DB::transaction(static function () use ($user) {
                 $user->articles()->each(function (Article $article) {
                     $admin = User::getFirstAdmin() ?? User::first();
                     $article->update(['user_id' => $admin->id]);
                 });
             });
         });
     }

     public static function getFirstAdmin(): ?Model
     {
         return self::query()->whereHas('roles', function ($query) {
             $query->where('name', Role::ADMIN);
         })->first();
     }

     protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
