<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileUrlResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var File $file */
        $file = $this;

        return [
            'url' => $file->path(),
        ];
    }
}
