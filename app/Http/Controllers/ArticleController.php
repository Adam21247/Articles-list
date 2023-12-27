<?php

namespace App\Http\Controllers;

use App\Http\Services\ArticleWebService;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use function session;


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

        return view('articles.show', ['article' => $article]);

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
        $article = Article::find($request->id);


        $input = $request->only('title', 'summary', 'content', 'categories');

        $article->title = $input['title'];
        $article->summary = $input['summary'];
        $article->content = $input['content'];

        if ($request->has('image')) {
            $destination = 'images' . $article->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');

            $extension = $file->getClientOriginalName();
            $filename = $extension;
            $file->move(public_path('images'), $filename);
            $article->image_name = $filename;
        }

        $article->save();
        $article->categories()->sync($input['categories']);
        if (session('tasks_url')) {
            return redirect(session('tasks_url'));
        }

        return redirect('articles');

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



