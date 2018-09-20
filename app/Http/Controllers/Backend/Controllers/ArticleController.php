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

    public function edit(Request $request, $id) 
    {
        $articleId = $id;
        return view('admin.editArticle',compact('articleId'));
    }

    public function editStore(Request $request) 
    {
        $articleData = $this->article->GetArticleDataById($request->id);
        return $articleData;  
    }

    public function store(Request $request)
    {
        $result;
        $requestData = $request->only(['articleName','articleContent','category','userId','isEdit','articleId','render']);
        if($requestData['isEdit']) {
            $result = $this->article->UpdateArticle($requestData);
        } else {
            $result = $this->article->CreateArticleWithCategory($requestData);
        }
        
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
