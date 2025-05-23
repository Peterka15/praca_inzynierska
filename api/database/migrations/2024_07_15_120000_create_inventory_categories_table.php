<?php

declare(strict_types=1);


use App\Models\InventoryCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryCategoriesTable extends Migration
{
    public function up(): void
    {
        Schema::create(InventoryCategory::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string(InventoryCategory::NAME);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(InventoryCategory::TABLE_NAME);
    }
}
