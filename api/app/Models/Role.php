<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\Enums\UserRole;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role query()
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role whereName($value)
 * @property-read UserRole $user_role
 * @property-read UserRole $user_role_enum
 * @mixin Eloquent
 */
final class Role extends ApiModel

{
    use HasFactory;

    public const TABLE_NAME = 'roles';

    public const ID = 'id';
    public const NAME = 'name';

    protected $fillable = [
        self::NAME,
    ];

    public function getUserRoleEnumAttribute(): UserRole
    {
        return UserRole::fromValue($this->id);
    }
}
