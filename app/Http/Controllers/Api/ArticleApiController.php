<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\ArticlesApiService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ArticleApiController extends Controller
{
    private ArticlesApiService $articleApiService;

    public function __construct(ArticlesApiService $articleApiService)
    {
        $this->articleApiService = $articleApiService;
    }

    public function index()
    {
        return $this->articleApiService->getAllArticles();
    }

    public function show($id)
    {
        return $this->articleApiService->getArticleById($id);
    }

    public function destroy($id)
    {
        return $this->articleApiService->deleteArticle($id);
    }

    public function store(Request $request)
    {
        return $this->articleApiService->addArticle($request);
    }

    public function update(Request $request)
    {
        return $this->articleApiService->editArticle($request);
    }

}


