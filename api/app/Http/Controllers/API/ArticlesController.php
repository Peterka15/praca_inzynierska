<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index(): JsonResponse
    {
        $articles = Article::latest()->get();

        return $this->successResponse(ArticleResource::collection($articles));
    }

    public function store(Request $request): JsonResponse
    {
        $validationRules = [
            Article::TITLE => 'required|string',
            Article::CONTENT => 'required|string',
            Article::TAGS => 'nullable|string'
        ];

        if (!$this->validateRequestData($request, $validationRules)) {
            return $this->errorResponse($this->validationErrors);
        }

        $requestData = $request->all();
        $requestData[Article::AUTHOR_ID] = $this->currentUser->id;

        $article = Article::create($requestData);

        $this->handleTags($article, $requestData[Article::TAGS]);

        return $this->successResponse(new ArticleResource($article));
    }

    public function show(int $id): JsonResponse
    {
        $article = Article::find($id);

        if ($article === null) {
            return $this->notFoundResponse();
        }

        return $this->successResponse(new ArticleResource($article));
    }

    public function update(Request $request, Article $article): JsonResponse
    {
        $validationRules = [
            Article::TITLE => 'string',
            Article::CONTENT => 'string',
            Article::TAGS => 'nullable|string'
        ];

        if (!$this->validateRequestData($request, $validationRules)) {
            return $this->errorResponse($this->validationErrors);
        }

        $requestData = $request->all();

        $article->fill($requestData);
        $article->save();

        $this->handleTags($article, $requestData[Article::TAGS]);

        return $this->successResponse(new ArticleResource($article));
    }

    public function destroy(Article $article): JsonResponse
    {
        $article->delete();

        return $this->successResponse();
    }

    private function handleTags(Article $article, ?string $tags): void
    {
        ArticleTag::whereArticleId($article->id)->delete();

        if (!$tags) {
            return;
        }

        $tagNamesArray = explode(',', $tags);

        foreach ($tagNamesArray as $tagName) {
            $tag = Tag::whereName($tagName)->first();

            if (!$tag) {
                $tag = new Tag();
                $tag->name = $tagName;
                $tag->save();
            }

            $articleTag = new ArticleTag();
            $articleTag->article_id = $article->id;
            $articleTag->tag_id = $tag->id;
            $articleTag->save();
        }
    }
}
