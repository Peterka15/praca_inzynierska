<?php

declare(strict_types=1);


use App\Models\Management;
use App\Models\Unit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagementsTable extends Migration
{
    public function up(): void
    {
        Schema::create(Management::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string(Management::NAME);
            $table->string(Management::FUNCTION);
            $table->foreignId(Management::UNIT_ID)->references(Unit::ID)->on(Unit::TABLE_NAME);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Management::TABLE_NAME);
    }
}
