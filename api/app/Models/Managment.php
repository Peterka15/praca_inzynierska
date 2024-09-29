<?php
declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * App\Models\Managment
 *
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static Builder|Managment newModelQuery()
 * @method static Builder|Managment newQuery()
 * @method static Builder|Managment query()
 * @mixin Eloquent
 */
final class Managment extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    public const TABLE_NAME = 'managment';

    public const ID = 'id';
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const UNIT = 'unit';
    public const FUNCTION = 'function';

    protected $fillable = [
        self::NAME,
        self::EMAIL,
        self::UNIT,
        self::FUNCTION
    ];

}
