<?php

declare(strict_types=1);

use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    public function up(): void
    {
        Schema::create(Tag::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string(Tag::NAME);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Tag::TABLE_NAME);
    }
}
