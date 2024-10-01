<?php

declare(strict_types=1);


use App\Models\Unit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    public function up(): void
    {
        Schema::create(Unit::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string(Unit::NAME);
        });
    }

    public function down(): void
    {
    }
}
