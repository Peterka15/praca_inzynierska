<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Article $article */
        $article = $this;

        return [
            Article::ID => $article->id,
            Article::AUTHOR => new UserResource($article->author),
            Article::TITLE => $article->title,
            Article::CONTENT => $article->content,
            Article::IMAGES => ImageUrlResource::collection($article->images),
            Article::COMMENTS => CommentResource::collection($article->comments),
            Article::TAGS => TagResource::collection($article->tags),
            Article::CREATED_AT => $article->created_at,
            Article::UPDATED_AT => $article->updated_at
        ];
    }
}
