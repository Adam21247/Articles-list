<?php

namespace App\Http\Controllers;

use App\Http\Services\ArticleWebService;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
    private ArticleWebService $articleWebService;

    public function __construct(ArticleWebService $articleWebService)
    {
        $this->articleWebService = $articleWebService;
    }

    public function index(Request $request)
    {
        return $this->articleWebService->showMainPage($request);
    }


    public function add()
    {
        $categories = Category::all();
        return view('articles.add', ['categories' => $categories]);

    }

    public function store(Request $request)
    {

        return $this->articleWebService->addArticle($request);
    }

    public function show($id)
    {
        $article = Article::find($id);
        $selectedCategories = $article->categories;

        return view('articles.show', compact('article', 'selectedCategories'));
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $allCategories = Category::all();
        $selectedCategories = $article->categories;
        return view('articles.edit', compact('article', 'allCategories', 'selectedCategories'));
    }


    public function update(Request $request)
    {
        return $this->articleWebService->editArticle($request);
    }


    public function destroy($id)
    {
        Article::destroy($id);

        return back();

    }

    public function addComment(Request $request)
    {

        if ($request->has('comment_content')) {
            Comment::create(
                ['comment_content' => $request->get('comment_content'),
                    'article_id' => $request->get('id')
                ]);
        }

        return back();
    }

    public function destroyComment($id)
    {
        Comment::destroy($id);

        return back();
    }

}



