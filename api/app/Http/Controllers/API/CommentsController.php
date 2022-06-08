<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validationRules = [
            Comment::AUTHOR => 'required|string',
            Comment::CONTENT => 'required|string',
            Comment::ARTICLE_ID => 'required|numeric|exists:App\Models\Articles,id'
        ];

        if (!$this->validateRequestData($request, $validationRules)) {
            return $this->errorResponse($this->validationErrors);
        }

        $requestData = $request->all();
        $comment = Comment::create($requestData);

        return $this->successResponse(new CommentResource($comment));
    }

    public function update(Request $request, Comment $comment): JsonResponse
    {
        $validationRules = [
            Comment::AUTHOR => 'string',
            Comment::CONTENT => 'string',
            Comment::ARTICLE_ID => 'numeric|exists:App\Models\Articles,id'
        ];

        if (!$this->validateRequestData($request, $validationRules)) {
            return $this->errorResponse($this->validationErrors);
        }

        $requestData = $request->all();

        $comment->fill($requestData);
        $comment->save();

        return $this->successResponse(new CommentResource($comment));
    }

    public function destroy(Comment $comment): JsonResponse
    {
        $comment->delete();

        return $this->successResponse();
    }
}
