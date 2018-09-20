<?php

namespace App\Http\Controllers\Api\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    //
    public function index(Request $request) {
      return response()->json([
        'code' => 200
      ]);
    }
}
