<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
class ImagesController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            Image::ARTICLE_ID => 'required|numeric|exists:App\Models\Article,id'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors());
        }

        $requestData = $request->all();

        $image = new Image();
        $image->article_id = $requestData[Image::ARTICLE_ID];
        $image->uuid = Uuid::uuid4();

        $imageHandle = $request->file('image');
        if ($imageHandle) {
            $imageHandle->storeAs('images', $image->uuid);
        } else {
            return $this->errorResponse('Cannot store image.');
        }

        $image->mime_type = $imageHandle->getMimeType();
        $image->save();

        return $this->successResponse(new ImageResource($image));
    }

    /**
     * @return Response | JsonResponse
     * @throws FileNotFoundException
     */
    public function show(string $uuid)
    {
        $image = Image::whereUuid($uuid)->first();

        if (is_null($image)) {
            return $this->notFoundResponse();
        }

        $path = "images/$image->uuid";

        if (!Storage::exists($path)) {
            throw new FileNotFoundException("File not found: $path");
        }

        $file = Storage::get($path);
        $mimeType = Storage::mimeType($path);

        return response($file, 200)->header('Content-Type', $mimeType);
    }

    public function destroy(string $uuid): JsonResponse
    {
        $image = Image::whereUuid($uuid)->first();

        if (is_null($image)) {
            return $this->notFoundResponse();
        }

        $path = "images/$image->uuid";
        Storage::delete($path);

        $image->delete();

        return $this->successResponse();
    }
}
