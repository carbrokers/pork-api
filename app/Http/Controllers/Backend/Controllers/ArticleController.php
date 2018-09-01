<?php

namespace App\Http\Controllers\Backend\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepositories as Article;

class ArticleController extends Controller
{
    protected $article;

    public function __construct(Article $article) 
    {
        $this->article = $article;
    }

    public function create()
    {
        return view('admin.editArticle');
    }

    public function store(Request $request)
    {
        $requestData = $request->only(['articleName','articleContent','category','userId']);
        $result = $this->article->CreateArticleWithCategory($requestData);
        
        return [
            'success' => $result
        ];
    }

    public function list(Request $result) 
    {
        $articleList = $this->article->GetArticleList();
        return view('admin.articleList',[
            'articleList' => $articleList 
        ]);
    }
}
