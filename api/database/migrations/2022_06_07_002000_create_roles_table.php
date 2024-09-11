<?php

declare(strict_types=1);



use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up(): void
    {
        Schema::create(Role::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string(Role::NAME);
        });
    }

    public function down(): void
    {
    }
}
