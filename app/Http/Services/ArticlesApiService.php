<?php


namespace App\Http\Services;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;


class ArticlesApiService
{

    public function getAllArticles()
    {
        $articles = Article::all();
        return response()->json($articles->load('categories', 'comments')->toArray());
    }

    public function getArticleById($id)
    {
        $article = Article::find($id);
        return response()->json($article->load('categories', 'comments')->toArray());

    }

    public function deleteArticle($id)
    {
        $article = Article::find($id);
        $article->delete();

        if ($article) {
            return ["article" => "record has been deleted"];
        } else {
            return ["article" => "record has not been deleted"];
        }
    }

    public function addArticle(Request $request)
    {
        $input = $request->only('title', 'summary', 'content', 'categories');

        $article = new Article();

        $article->title = $input['title'];
        $article->summary = $input['summary'];
        $article->content = $input['content'];
        $article->save();
        $article->categories()->attach($this->getArrayOfIds($input['categories']));

        return response()->json(['message' => 'Added successfully'], 201);
    }


    public function editArticle(Request $request)
    {
        $article = Article::find($request->id);

        $input = $request->only('title', 'summary', 'content', 'categories');

        $article->title = $input['title'];
        $article->summary = $input['summary'];
        $article->content = $input['content'];
        $article->save();
        $article->categories()->sync($this->getArrayOfIds($input['categories']));

        return response()->json(['message' => 'Updated successfully'], 201);
    }

    /**
     * @param $categories
     * @return array
     */
    private function getArrayOfIds($categories): array
    {
        return Arr::pluck($categories, 'id');
    }
}
