<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\ArticlesApiService;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ArticleApiController extends Controller
{
    private $articleApiService;

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
        $article = Article::find($id);

        if ($article->image_name == null && $article->created_at == $article->updated_at) {
            return response()->json($article->load('categories', 'comments')->makeHidden(['image_name', 'updated_at'])->toArray());
        } else {
            return response()->json($article->load('categories', 'comments')->toArray());
        }
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        if ($article) {
            return ["article" => "record has been deleted"];
        } else {
            return ["article" => "record has not been deleted"];
        }
    }

    public function store(Request $request)
    {
        $input = $request->only('title', 'summary', 'content');

        $article = new Article();

        $article->title = $input['title'];
        $article->summary = $input['summary'];
        $article->content = $input['content'];

        $article->save();

        return response()->json(null, 204);
    }

    public function update(Request $request)
    {

        $article = Article::find($request->id);

        $input = $request->only('title', 'summary', 'content');

        $article->title = $input['title'];
        $article->summary = $input['summary'];
        $article->content = $input['content'];
        $article->save();

        return response()->json(['message' => 'Update successfully'], 201);

    }

}


