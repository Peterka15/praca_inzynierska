<?php

declare(strict_types=1);

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up(): void
    {
        Schema::create(Comment::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->foreignId(Comment::ARTICLE_ID)->references(Article::ID)->on(Article::TABLE_NAME);
            $table->text(Comment::AUTHOR);
            $table->text(Comment::CONTENT);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Comment::TABLE_NAME);
    }
}
