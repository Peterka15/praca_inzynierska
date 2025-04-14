<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FileResource;
use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FilesController extends Controller
{
    public function index(): JsonResponse
    {
        $files = File::latest()->get();

        return $this->successResponse(FileResource::collection($files));
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            File::NAME => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors());
        }

        $requestData = $request->all();

        $file = new File();
        $file->user_id = $this->currentUser->id;
        $file->name = $requestData[File::NAME];
        $file->uuid = Uuid::uuid4();

        $fileHandle = $request->file('file');
        if ($fileHandle) {
            $extension = $fileHandle->getClientOriginalExtension();
            $file->extension = $extension;
            $fileHandle->storeAs('files', $file->uuid . '.' . $extension);
            $file->mime_type = $fileHandle->getMimeType();
        } else {
            return $this->errorResponse('Cannot store file.');
        }

        $file->save();

        return $this->successResponse(new FileResource($file));
    }

    /**
     * @param string $uuid
     * @return JsonResponse|StreamedResponse
     */
    public function show(string $uuid)
    {
        $file = File::whereUuid($uuid)->first();

        if (is_null($file)) {
            return $this->notFoundResponse();
        }

        $path = "files/{$file->uuid}.{$file->extension}";
        return Storage::download($path, "{$file->name}.{$file->extension}");
    }

    public function destroy(string $uuid): JsonResponse
    {
        $file = File::whereUuid($uuid)->first();

        if (is_null($file)) {
            return $this->notFoundResponse();
        }

        $path = "files/$file->uuid";
        Storage::delete($path);

        $file->delete();

        return $this->successResponse();
    }
}
