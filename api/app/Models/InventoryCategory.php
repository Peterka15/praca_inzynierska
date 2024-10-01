<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
