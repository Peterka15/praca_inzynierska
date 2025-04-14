<?php

declare(strict_types=1);

use App\Models\File;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    public function up(): void
    {
        Schema::create(File::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->uuid(File::UUID);
            $table->foreignId(File::USER_ID)->references(User::ID)->on(User::TABLE_NAME);
            $table->string(File::NAME);
            $table->string(File::MIME_TYPE);
            $table->string(File::EXTENSION);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Image::TABLE_NAME);
    }
}
