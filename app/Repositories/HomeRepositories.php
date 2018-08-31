<?php
    namespace App\Repositories;
    use App\Model\Article as Article;
    use App\Model\Category as Category;
    

    class HomeRepositories
    {
        public function count() 
        {

            $count = [
                'article' => Article::count(),
                'category' => Category::count()
            ];

            $data = [
                'count' => $count
            ];
            return $data;
        }
    }