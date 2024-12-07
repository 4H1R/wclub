<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\PermissionsEnum;
use App\Enums\RolesEnum;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
        return $this->hasRole(RolesEnum::SuperAdmin);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isSuperAdmin() || $this->hasPermissionTo(PermissionsEnum::ViewAdminPanel);
    }

    public function getFilamentName(): string
    {
        return $this->full_name;
    }

    /**
     * @return Attribute<string,string>
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value, array $attributes) => $attributes['first_name'].' '.$attributes['last_name'],
        );
    }

    /**
     * @return BelongsToMany<Role>
     */
    public function safeRoles(): BelongsToMany
    {
        // @phpstan-ignore-next-line
        return $this
            ->roles()
            // @phpstan-ignore-next-line
            ->unless(Auth::user()?->isSuperAdmin(), fn (Builder $builder) => $builder->where('name', '!=', RolesEnum::SuperAdmin));
    }
}
