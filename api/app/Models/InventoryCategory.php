<?php
declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\InventoryCategory
 *
 * @property int $id
 * @property string $name
 * @method static Builder|InventoryCategory newModelQuery()
 * @method static Builder|InventoryCategory newQuery()
 * @method static Builder|InventoryCategory query()
 * @method static Builder|InventoryCategory whereId($value)
 * @method static Builder|InventoryCategory whereName($value)
 * @mixin Eloquent
 */
final class InventoryCategory extends ApiModel
{
    use HasFactory;

    public const TABLE_NAME = 'inventory_categories';

    public const ID = 'id';
    public const NAME = 'name';

    protected $fillable = [
        self::NAME,
    ];
}
