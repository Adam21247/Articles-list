<?php


namespace App\Http\Services;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class ArticlesApiService
{
        public function getAllArticles(){
            $articles = Article::all();
            foreach ($articles as $article) {
                if ($article->image_name == null && $article->created_at == $article->updated_at) {
                    return response()->json($articles->load('categories', 'comments')->makeHidden(['image_name', 'updated_at'])->toArray());
                }
                return response()->json($articles->load('categories', 'comments')->toArray());
            }
        }
}
