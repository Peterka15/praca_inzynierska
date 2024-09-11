<?php
declare(strict_types=1);

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static UserFactory factory(...$parameters)
 * @method static Builder|Unit newModelQuery()
 * @method static Builder|Unit newQuery()
 * @method static Builder|Unit query()
 * @method static Builder|Unit whereCreatedAt($value)
 * @method static Builder|Unit whereEmail($value)
 * @method static Builder|Unit whereId($value)
 * @method static Builder|Unit whereName($value)
 * @method static Builder|Unit wherePassword($value)
 * @method static Builder|Unit whereRememberToken($value)
 * @method static Builder|Unit whereUpdatedAt($value)
 * @mixin
 */
final class Unit extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    public const TABLE_NAME = 'unit';

    public const ID = 'id';
    public const NAME = 'name';

    protected $fillable = [
        self::NAME
    ];

}
