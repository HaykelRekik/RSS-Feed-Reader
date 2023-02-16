<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponser;
use App\Services\ArticleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ImportArticlesRequest;
use App\Http\Resources\ArticleResource;

class ArticleController extends Controller
{
    use ApiResponser;

    public function __construct(protected ArticleService $articleService)
    {
    }
    /**
     * Display a list of imported Articles.
     */
    public function index()
    {
        $articles = $this->articleService->getAllArticles();

        return $this->successResponse(
            message: "Articles retrieved successfully",
            data: ArticleResource::collection($articles)
        );
    }

    /**
     * Import and Store list of Articles from a RSS feed.
     * 
     */
    public function store(ImportArticlesRequest $request)
    {
        $this->articleService->importArticlesFrom($request->input('siteRssUrl'));

        return $this->successResponse(
            message: "Articles imported successfully",
            code: 201
        );
    }
}
