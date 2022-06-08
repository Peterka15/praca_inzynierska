<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Comment $comment */
        $comment = $this;

        return [
            Comment::ID => $comment->id,
            Comment::ARTICLE_ID => $comment->article_id,
            Comment::AUTHOR => $comment->author,
            Comment::CONTENT => $comment->content,
            Comment::CREATED_AT => $comment->created_at,
            Comment::UPDATED_AT => $comment->updated_at
        ];
    }
}
