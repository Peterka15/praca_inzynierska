<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageUrlResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Image $image */
        $image = $this;

        return [
            'url' => $image->path(),
        ];
    }
}
