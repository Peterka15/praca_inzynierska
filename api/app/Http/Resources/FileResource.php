<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\File;
use App\Models\User;
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
            File::USER => new UserResource($file->user),
            File::NAME => $file->name,
            File::MIME_TYPE => $file->mime_type,
            File::EXTENSION => $file->extension,
            File::CREATED_AT => $file->created_at,
            File::UPDATED_AT => $file->updated_at,
        ];
    }
}
