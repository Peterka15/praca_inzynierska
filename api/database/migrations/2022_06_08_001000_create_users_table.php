<?php

declare(strict_types=1);

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
            $table->string(User::PASSWORD)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(User::TABLE_NAME);
    }
}
