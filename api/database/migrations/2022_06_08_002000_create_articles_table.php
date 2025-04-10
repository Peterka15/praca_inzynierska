<?php

declare(strict_types=1);

use App\Models\Article;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    public function up(): void
    {
        Schema::create(Article::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->foreignId(Article::AUTHOR_ID)->references(User::ID)->on(User::TABLE_NAME);
            $table->string(Article::TITLE);
            $table->text(Article::CONTENT);
            $table->boolean(Article::IS_DELETED)->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Image::TABLE_NAME);
    }
}
