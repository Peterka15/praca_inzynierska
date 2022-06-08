<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagWithArticlesResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Tag $tag */
        $tag = $this;

        return [
            Tag::ID => $tag->id,
            Tag::NAME => $tag->name,
            Tag::ARTICLES => $tag->articles
        ];
    }
}
