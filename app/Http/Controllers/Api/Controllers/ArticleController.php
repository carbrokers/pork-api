<?php

namespace App\Http\Controllers\Api\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepositories as Article;

class ArticleController extends Controller
{
    //
    protected $article;

    public function __construct(Article $article) {
      $this->article = $article;
    }

    public function index(Request $request) {
      $articleListData = $this->article->ApiGetArticleList();
      return response()->json($articleListData);
    }

    public function article(Request $request) {
      $data = $this->article->GetArticleDataById($request->get('id'));
      $json = [
        'title'=> $data['title'],
        'content'=> $data['render'],
        'categories'=> $data['categories']
      ];
      return response()->json($json);
      
    }
}
