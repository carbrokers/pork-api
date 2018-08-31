<?php

namespace App\Http\Controllers\Backend\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CatgRepositories as Catg;

class Category extends Controller
{
    //
    protected $category;

    public function __construct(Catg $category) 
    {
        $this->category = $category;
    }

    public function index(Request $request)
    {
        $contain= $request->query('contain');
        if(empty($contain)) {
            return [];
        }
        $data = $this->category->GetCategoryListByInput($contain);
        return $data;
    }
}
