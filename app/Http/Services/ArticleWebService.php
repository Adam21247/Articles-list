<?php


namespace App\Http\Services;


use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ArticleWebService
{

    public function showMainPage(Request $request)
    {

        $perPage = $request->query('perPage');
        $perPage !== null ? $perPage = $perPage : $perPage = 25;


        $sort = $request->query('sort');
        $sort !== null ? $sort = $sort : $sort = 'asc';

        $sortBy = $request->query('sortBy');
        $sortBy !== null ? $sortBy = $sortBy : $sortBy = 'id';

        $articles = Article::orderBy($sortBy, $sort)
            ->paginate($perPage);

        Session::put('tasks_url', request()->fullUrl());


        return view('articles.index')->with('articles', $articles);
    }

    public function addArticle(Request $request){

        $request->validate([
            'addedImage' => 'mimes:jpg,png,webp,jpeg'
        ]);


        if ($request->has('addedImage')){
            $ImageName = $request->addedImage->getClientOriginalName();
            $request->file('addedImage')->move(public_path('/images'), $ImageName);
        } else {
            $ImageName = null;
        }

        $input = $request->only('title', 'summary', 'content', 'image_name', 'categories');

        $article = new Article();
        $article->title = $input['title'];
        $article->summary = $input['summary'];
        $article->content = $input['content'];
        $article->image_name = $ImageName;
        $article->save();

        $article->categories()->attach($input['categories']);


        if (session('tasks_url')) {
            return redirect(session('tasks_url'));
        }


        return view('articles');
    }

    public function editArticle(Request $request){
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
}
