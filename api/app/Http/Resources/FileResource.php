<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
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
            File::ID => $file->id,
            File::URL => $file->path(),
            File::UUID => $file->uuid,
            File::USER_ID => $file->user_id,
            File::NAME => $file->name,
            File::MIME_TYPE => $file->mime_type
        ];
    }
}
