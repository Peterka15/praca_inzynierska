<?php

declare(strict_types=1);

use App\Models\Role;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create(User::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string(User::NAME);
            $table->string(User::EMAIL)->nullable()->unique();
            $table->foreignId(User::ROLE_ID)->references(Role::ID)->on(Role::TABLE_NAME);
            $table->foreignId(User::UNIT_ID)->references(Unit::ID)->on(Unit::TABLE_NAME);
            $table->string(User::PASSWORD)->nullable();
            $table->boolean(User::PASSWORD_CHANGE_IS_REQUIRED)->default(true);
            $table->string(User::PASSWORD_CHANGE_TOKEN)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(User::TABLE_NAME);
    }
}
