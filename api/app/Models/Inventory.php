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
 * App\Models\Inventory
 *
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static Builder|Inventory newModelQuery()
 * @method static Builder|Inventory newQuery()
 * @method static Builder|Inventory query()
 * @mixin Eloquent
 */
final class Inventory extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    public const TABLE_NAME = 'inventory';

    public const ID = 'id';
    public const NAME = 'name';
    public const AMOUNT = 'amount';
    public const CATEGORY = 'category';
    public const UNIT = 'unit';
    public const ONSTATE = 'onstate';


    protected $fillable = [
        self::NAME,
        self::AMOUNT,
        self::CATEGORY,
        self::UNIT,
        self::ONSTATE,
    ];


}
