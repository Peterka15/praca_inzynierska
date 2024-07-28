<?php

declare(strict_types=1);


use App\Models\Managment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagementTable extends Migration
{
    public function up(): void
    {
        Schema::create(Managment::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string(Managment::NAME);
            $table->string(Managment::FUNCTION);
            $table->string(Managment::UNIT);
            $table->string(Managment::EMAIL);
        });
    }

    public function down(): void
    {
    }
}
