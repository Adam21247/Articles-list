<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ArticleApiController extends Controller
{
    public function index()
    {
//        $articles = Article::all();

        $articles = Article::with('categories')->get();

        // you can return json if it's an API,
        return response()->json(['posts' => $articles], 200);

//        return response()->json($articles->toArray());
    }

    public function show($id)
    {
//        $article = Article::find($id);
//
//        return response()->json($article->toArray());

        $article = Article::find($id);

// Pobieramy kategorie przypisane do artykułu
        $categories = $article->categories;

// Teraz możesz wyświetlić nazwy kategorii
        foreach ($categories as $category) {
            echo $category->name;
        }

//        return response()->json($article->toArray());
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
//        $input = $request->only('title', 'summary', 'content');

//        $article = new Article();
//
//        $article->title = $input['title'];
//        $article->summary = $input['summary'];
//        $article->content = $input['content'];

//        $article = Article::find(1);


        $categories = Category::all();
        $articles = Article::all();

        foreach ($articles as $article) {
            $article->categories()->sync($categories);
        }

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

        return response()->json(['message' => 'Update successfully'], 204);

    }


}


