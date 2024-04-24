<?php

namespace Modules\User\App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
 use Illuminate\Database\Eloquent\Casts\Attribute;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Relations\BelongsTo;
 use Illuminate\Database\Eloquent\SoftDeletes;
 use Illuminate\Foundation\Auth\User as Authenticatable;
 use Illuminate\Notifications\Notifiable;
 use Illuminate\Support\Collection;
 use Laravel\Sanctum\HasApiTokens;
 use Modules\FileManager\App\Models\Image;
 use Modules\Role\App\Models\Role;
 use Modules\User\Database\Factories\UserFactory;
 use Spatie\Permission\Traits\HasRoles;

 class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'picture_id',
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

     public function picture(): BelongsTo
     {
         return $this->belongsTo(Image::class, 'picture_id');
     }

     public function role(): \Spatie\Permission\Models\Role
     {
         return $this->roles()->first();
     }

     protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
