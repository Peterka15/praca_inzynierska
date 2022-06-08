<?php

declare(strict_types=1);

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTagsTable extends Migration
{
    public function up(): void
    {
        Schema::create(ArticleTag::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->foreignId(ArticleTag::TAG_ID)->references(Tag::ID)->on(Tag::TABLE_NAME);
            $table->foreignId(ArticleTag::ARTICLE_ID)->references(Article::ID)->on(Article::TABLE_NAME);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(ArticleTag::TABLE_NAME);
    }
}
