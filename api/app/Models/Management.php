<?php
declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Management
 *
 * @property int $id
 * @property string $name
 * @property string $function
 * @property int $unit_id
 * @method static Builder|Management newModelQuery()
 * @method static Builder|Management newQuery()
 * @method static Builder|Management query()
 * @method static Builder|Management whereFunction($value)
 * @method static Builder|Management whereId($value)
 * @method static Builder|Management whereName($value)
 * @method static Builder|Management whereUnitId($value)
 * @mixin Eloquent
 */
final class Management extends ApiModel
{
    use HasFactory;

    public const TABLE_NAME = 'management';

    public const ID = 'id';
    public const NAME = 'name';
    public const UNIT_ID = 'unit_id';
    public const FUNCTION = 'function';

    protected $fillable = [
        self::NAME,
        self::UNIT_ID,
        self::FUNCTION
    ];

    public function unit(): HasOne
    {
        return $this->hasOne(Unit::class, Unit::ID, self::UNIT_ID);
    }
}
