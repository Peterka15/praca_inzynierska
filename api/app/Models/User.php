<?php
declare(strict_types=1);

namespace App\Models;

use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property int $role_id
 * @property int $unit_id
 * @property string|null $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $required_password_change
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Role|null $role
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read Unit|null $unit
 * @method static UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRequiredPasswordChange($value)
 * @method static Builder|User whereRoleId($value)
 * @method static Builder|User whereUnitId($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Eloquent
 */
final class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    public const TABLE_NAME = 'users';

    public const ID = 'id';
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const PASSWORD = 'password';
    public const UNIT = 'unit';

    public const UNIT_ID = 'unit_id';
    public const ROLE = 'role';

    public const ROLE_ID = 'role_id';

    public const REQUIRED_PASSWORD_CHANGE = "required_password_change";

    protected $fillable = [
        self::NAME,
        self::EMAIL,
        self::PASSWORD,
        self::UNIT_ID,
        self::ROLE_ID,
        self::REQUIRED_PASSWORD_CHANGE
    ];

    protected $hidden = [
        self::PASSWORD,
    ];

    protected $casts = [
        self::UPDATED_AT => 'datetime',
        self::CREATED_AT => 'datetime'
    ];

    public function unit(): HasOne
    {
        return $this->hasOne(Unit::class, Unit::ID, self::UNIT_ID);
    }

    public function role(): HasOne
    {
        return $this->hasOne(Role::class, Role::ID, self::ROLE_ID);
    }

}
