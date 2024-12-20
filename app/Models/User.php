<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable implements FilamentUser, HasName
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isSuperAdmin(): bool
    {
        return $this->hasRole(RoleEnum::SuperAdmin);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasPermissionTo(PermissionEnum::ViewAdminPanel);
    }

    public function getFilamentName(): string
    {
        return $this->full_name;
    }

    /**
     * @return Attribute<int,int>
     */
    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn (?int $value, array $attributes) => Carbon::parse($attributes['birth_date'])->age,
        )->shouldCache();
    }

    /**
     * @return Attribute<string,string>
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value, array $attributes) => $attributes['first_name'].' '.$attributes['last_name'],
        )->shouldCache();
    }

    /**
     * @return BelongsToMany<Role>
     */
    public function safeRoles(): BelongsToMany
    {
        return $this
            ->roles()
            ->unless(Auth::user()?->isSuperAdmin(), fn (Builder $builder) => $builder->where('name', '!=', RoleEnum::SuperAdmin));
    }

    /**
     * @return BelongsToMany<Contest>
     */
    public function contestRegistrations(): BelongsToMany
    {
        return $this->belongsToMany(Contest::class, 'contest_user_registrations');
    }

    /**
     * @return BelongsToMany<Series>
     */
    public function ownedSeries(): BelongsToMany
    {
        return $this->belongsToMany(Series::class, 'user_owned_series');
    }
}
