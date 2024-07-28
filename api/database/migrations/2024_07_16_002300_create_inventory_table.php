<?php

declare(strict_types=1);


use App\Models\Inventory;
use App\Models\Unit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTable extends Migration
{
    public function up(): void
    {
        Schema::create(Inventory::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string(Inventory::NAME);
            $table->integer(Inventory::AMOUNT);
            $table->string(Inventory::CATEGORY);
            $table->string(Inventory::UNIT);
            $table->foreignId(Inventory::UNIT_ID)->references(Unit::ID)->on(Unit::TABLE_NAME);
            $table->boolean(Inventory::ONSTATE);
        });
    }

    public function down(): void
    {
    }
}
