<?php
    namespace App\Repositories;
    use App\Model\Category;

    class CatgRepositories
    {
       public function GetCategoryListByInput($part)
       {
            $data = Category::where('name','like', "%$part%")->get(['id','name']);
            return $data;
       }
    }