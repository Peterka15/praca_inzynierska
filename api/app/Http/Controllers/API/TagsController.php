<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Http\Resources\TagWithArticlesResource;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class TagsController extends Controller
{
    public function index(): JsonResponse
    {
        $tags = Tag::orderBy(Tag::NAME)->get();

        return $this->successResponse(TagResource::collection($tags));
    }

    public function show(int $id): JsonResponse
    {
        $article = Tag::find($id);

        if ($article === null) {
            return $this->notFoundResponse();
        }

        return $this->successResponse(new TagWithArticlesResource($article));
    }
}
