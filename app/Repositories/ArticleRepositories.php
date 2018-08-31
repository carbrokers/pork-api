<?php
    namespace App\Repositories;
    use App\Model\Category;
    use App\Model\Article;

    class ArticleRepositories
    {
      protected $category;
      protected $article;

      public function __construct()
      {
        $this->category = new Category();
        $this->article = new Article();
      }
      
      public function CreateArticleWithCategory($requestData) 
      {
        $userId = $requestData['userId'];
        $articleId = '';
        $categoryIds = [];
        $createCatgData = [];

        foreach ($requestData['category'] as $key => $cate) {
          if(array_key_exists('isCreate',$cate)) {
            array_push($createCatgData,[
              'name' => $cate['name'],
              'created_at'=> date('Y-m-d H:i:s'),
              'updated_at'=> date('Y-m-d H:i:s')
            ]);
          } else {
            array_push($categoryIds,$cate['id']);
          }
        }

        $rs = $this->category->addCategories($createCatgData);
        //获取所有的分类id
        $categoryIds = array_merge($categoryIds,$rs);
      }
    }