<?php


namespace App\Http\Services;


use App\Models\Article;
use Illuminate\Http\Request;
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

}
