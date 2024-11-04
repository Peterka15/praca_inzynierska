<?php
declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Unit
 *
 * @property int $id
 * @property string $name
 * @method static Builder|Unit newModelQuery()
 * @method static Builder|Unit newQuery()
 * @method static Builder|Unit query()
 * @method static Builder|Unit whereId($value)
 * @method static Builder|Unit whereName($value)
 * @mixin Eloquent
 */
final class Unit extends ApiModel
{
    use HasFactory;

    public const TABLE_NAME = 'units';

    public const ID = 'id';
    public const NAME = 'name';

    protected $fillable = [
        self::NAME,
    ];
}
