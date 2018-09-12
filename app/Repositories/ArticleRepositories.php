<?php
    namespace App\Repositories;
    use App\Model\Category;
    use App\Model\Article;
    use App\Model\ArtsCatgsRelation;

    class ArticleRepositories
    {
      protected $category;
      protected $article;

      public function __construct()
      {
        $this->category = new Category();
        $this->article = new Article();
      }
      
      //创建文章
      public function CreateArticleWithCategory($requestData) 
      {
        $userId = $requestData['userId'];
        $articleId = '';
        $categoryIds = $this->CreateAndGetCategoryIds($requestData['category']);
        //插入并获取文章id
        $articleId = Article::create([
            'title' => $requestData['articleName'],
            'body' => $requestData['articleContent'],
            'user_id' => $requestData['userId'],
          ])->id;
        //批量添加结果
        $result = ArtsCatgsRelation::bactchAdd($articleId,$categoryIds);
        return $result;
      }

      //更新文章
      public function UpdateArticle($requestData)
      {
        $categoryIds = $this->CreateAndGetCategoryIds($requestData['category']);
        Article::where('id',$requestData['articleId'])
          ->update(['title' => $requestData['articleName'],'body' => $requestData['articleContent']]);
        ArtsCatgsRelation::where('article_id',$requestData['articleId'])->delete();
        $result = ArtsCatgsRelation::bactchAdd($requestData['articleId'],$categoryIds);
        return true;
      }

      public function GetArticleList()
      {
          return Article::all(['title','id','created_at','favorites_count'])->toJson();
      }

      public function GetArticleDataById($id) 
      {
        $article = Article::where('id',$id)->first();
        $catgs = [];
        foreach ($article->categories as $catg) {
          array_push($catgs,[
            'id' => $catg->id,
            'name' => $catg->name
          ]);
        }
        return [
          'title' => $article->title,
          'body' => $article->body,
          'categories' => $catgs
        ];
      }

      public function CreateAndGetCategoryIds($categories)
      {
        $createCatgData = [];
        $categoryIds = [];
        foreach ($categories as $key => $cate) {
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
        return $categoryIds;
      }
    }