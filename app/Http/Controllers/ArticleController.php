<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('perPage');
        $perPage !== null ? $perPage = $perPage : $perPage = 25;


        $sort = $request->query('sort');
        $sort !== null ? $sort = $sort : $sort = 'asc';

        $sortBy = $request->query('sortBy');
        $sortBy !== null ? $sortBy = $sortBy : $sortBy = 'id';

        $articles = Article::orderBy($sortBy, $sort)
            ->paginate($perPage);


        return view('articles.index')->with('articles', $articles);

    }


    public function add()
    {
        return view('articles.add');
    }

    public function store(Request $request)
    {

        $request->validate([
            'image' => 'mimes:jpg,png,webp,jpeg|max:2021'
        ]);


        $newImageName = time() . '-' . $request->name . '.';

        if ($request->has('image')) {
            $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);
        }


        $input = $request->only('title', 'summary', 'content', 'image_name');

        $article = new Article();
        $article->title = $input['title'];
        $article->summary = $input['summary'];
        $article->content = $input['content'];
        $article->image_name = $newImageName;


        $article->save();

        return redirect('articles');
    }

    public function show($id)
    {
        $article = Article::find($id);

        return view('articles.show', ['article' => $article]);
    }

    public function edit($id)
    {
        $article = Article::find($id);

        return view('articles.edit', ['article' => $article]);
    }


    public function update(Request $request)
    {
        $article = Article::find($request->id);

        $input = $request->only('title', 'summary', 'content');

        $article->title = $input['title'];
        $article->summary = $input['summary'];
        $article->content = $input['content'];


        $article->save();

        return redirect('articles');
    }


    public function destroy($id)
    {
        Article::destroy($id);

        return redirect('articles');
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


