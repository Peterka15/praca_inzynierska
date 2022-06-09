<?php

declare(strict_types=1);

use App\Models\Article;
use App\Models\Image;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    public function up(): void
    {
        Schema::create(Image::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->uuid(Image::UUID);
            $table->string(Image::MIME_TYPE);
            $table->foreignId(Image::ARTICLE_ID)->references(Article::ID)->on(Article::TABLE_NAME);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Image::TABLE_NAME);
    }
}
