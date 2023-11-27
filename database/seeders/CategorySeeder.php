<?php


namespace Database\Seeders;


use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategorySeeder extends Seeder
{
    const CATEGORIES = [
        ['name' => 'Sport'],
        ['name' => 'Politics'],
        ['name' => 'Lifestyle'],
        ['name' => 'News'],
        ['name' => 'Weather'],
        ['name' => 'Economy'],
        ['name' => 'Health'],
        ['name' => 'Travel'],
        ['name' => 'Opinion'],
    ];


    public function run()
    {


        DB::table('categories')->insert(self::CATEGORIES);

        $categories = Category::pluck('id');
        $articleIds = Article::pluck('id');
        $articleCategoryPivot = [];

        foreach ($articleIds as $articleId) {
            if ($articleId % 2 == 0) {
                foreach ($categories as $category) {
                    if ($category % 3 == 0) {
                        $articleCategoryPivot[] = [
                            'category_id' => $category,
                            'article_id' => $articleId
                        ];
                    }
                }
            } else {
                foreach ($categories as $category) {
                    if ($category % 2 == 0) {
                        $articleCategoryPivot[] = [
                            'category_id' => $category,
                            'article_id' => $articleId
                        ];
                    }
                }
            }
        }

        DB::table('article_category')->insert($articleCategoryPivot);
    }
}



